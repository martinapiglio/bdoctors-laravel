<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Sponsorship;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsorships = Sponsorship::all();

        return view('admin.sponsorships.index', compact('sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sponsorship $sponsorship)
    {
        //retrieve the sponsorships slug
        $fullUrl = URL::full();
        // ?basic=
        $parsed_url = parse_url($fullUrl);
        parse_str($parsed_url['query'], $query_params);
        $param_keys = array_keys($query_params);

        $slug = $param_keys[0];

        $detail = Detail::where('user_id', Auth::id())->first();
        $sponsorship = Sponsorship::where('slug', '=', $slug)->first();

        // Handle the situation if no sponsorship is found.
        // if (!$sponsorship) {
        //     return response()->json(['message' => 'Sponsorship not found']);
        // }

        // Get the payment method nonce from the request
        $nonceFromTheClient = 'fake-valid-nonce';

        // Generate a client token
        $gateway = app('Braintree\Gateway');

        // Use the client token and nonce to create a transaction
        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => ['submitForSettlement' => true]
        ]);

        // Handle the result of the transaction
        if ($result->success) {

            $transaction = $result->transaction;

            //Insert data into the bridge table - da fare quando si avrà lo slug da sponsorship
            DB::table('detail_sponsorship')->insert([
                'detail_id' => $detail->id,
                'sponsorship_id' => $sponsorship->id,
                'end_date' => Carbon::now(),
                'transactionid' => $transaction->id,
            ]);

            $startDate = DB::table('detail_sponsorship')->where('transactionid', $transaction->id)->value('start_date');
            // dd($startDate);

            DB::table('detail_sponsorship')
                ->where('transactionid', $transaction->id)
                ->update(['end_date' => \Carbon\Carbon::parse($startDate)->addHours($sponsorship->duration)]);

            return view('admin.sponsorships.payment');
        } else {
            // Transaction failed
            $errorString = "";
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return response()->json(['message' => 'Transaction failed', 'errors' => $errorString]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
        $detail = Detail::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();

        $gateway = app('Braintree\Gateway');
        $clientToken = $gateway->clientToken()->generate();
        return view('admin.sponsorships.show', compact('detail', 'user', 'sponsorship', 'clientToken'));
    }

    public function getClientToken()
    {
        $gateway = app('Braintree\Gateway');
        $clientToken = $gateway->clientToken()->generate();
        return response()->json(['clientToken' => $clientToken]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorship $sponsorship)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
    public function payment()
    {
        return view('admin.sponsorships.payment');
    }
}
