<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request)
    {
        //
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

    public function purchase(Request $request)
    {
        // Get the payment method nonce from the request
        $nonceFromTheClient = 'fake-valid-nonce';

        // Generate a client token
        $gateway = app('Braintree\Gateway');
        // $clientToken = $gateway->clientToken()->generate();

        // Use the client token and nonce to create a transaction
        $result = $gateway->transaction()->sale([
        'amount' => '10.00', // replace this with the actual amount
        'paymentMethodNonce' => $nonceFromTheClient,
        'options' => [ 'submitForSettlement' => true ]
            ]);

        // Handle the result of the transaction
    if ($result->success) {
        // Transaction was successful
        $transaction = $result->transaction;
        return Redirect::to('admin.sponsorships.index');
    } else {
        // Transaction failed
        $errorString = "";
        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }
        return response()->json(['message' => 'Transaction failed', 'errors' => $errorString]);
        }
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
        //
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
}
