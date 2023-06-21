<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use App\Models\Message;
use App\Models\Review;
use App\Models\Spec;
use App\Models\Sponsorship;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*
    public function index(Request $request)
    {
        $requestData = $request->all();

        // $users = User::all();
        // $details = Detail::all();
        $specs = Spec::all();
        // $sponsorships = Sponsorship::all();
        // $messages = Message::all();
        $reviews = Review::all();
        $votes = Vote::all();

        // I check if there is a parameter mainspec in the request and that is not null
        if ($request->has('mainspec') && $requestData['mainspec'] != "") {

            $users = User::where('mainspec', $requestData['mainspec'])
                ->orWhereHas('detail.specs', function ($query) use ($requestData) {
                    $query->where('specs.title', $requestData['mainspec']);
                })
                ->with('detail.specs', 'reviews', 'votes')
                ->get();

            if ($request->has('vote') && $requestData['vote'] != "") {

                $users = User::where('vote', '>=', $requestData['vote'])

                    ->with('detail.specs', 'reviews', 'votes')
                    ->get();

                if (count($users) == 0) {

                    return response()->json([
                        'success' => false,
                        'error' => 'No users found',
                    ]);
                }
            };


            if (count($users) == 0) {

                return response()->json([
                    'success' => false,
                    'error' => 'No users found',
                ]);
            }
        } else {

            $users = User::with('detail.specs', 'reviews', 'votes')->get();
            // with('details', 'specs', 'sponsorships', 'messages', 'reviews', 'votes')->get();
            // ->orderBy('projects.created_at', 'desc')
            // ->paginate(2);
        };

        return response()->json([
            'success' => true,
            'results' => $users,
            // 'details' => $details,
            'specs' => $specs,
            // 'sponsorships' => $sponsorships,
            // 'messages' => $messages,
            'reviews' => $reviews,
            'votes' => $votes
        ]);
    }
    */

    public function index(Request $request)
    {
        $requestData = $request->all();

        $specs = Spec::all();
        $reviews = Review::all();
        $votes = Vote::all();

        // start the query
        $query = User::query();

        // if mainspec is present, add it to the query
        if ($request->has('mainspec') && $requestData['mainspec'] != "") {
            $query->where('mainspec', $requestData['mainspec'])
                ->orWhereHas('detail.specs', function ($query) use ($requestData) {
                    $query->where('specs.title', $requestData['mainspec']);
                });
        }
        if ($request->has('vote') && $requestData['vote'] != "") {
            $query->whereHas('votes', function ($query) use ($requestData) {
                $query->select(DB::raw('user_id'))
                    ->groupBy('user_id')
                    ->havingRaw('AVG(vote) >= ?', [$requestData['vote']]);
            });
        }
        /*
        if ($request->has('order') && $requestData['order'] != "") {
            $order = $requestData['order']; // 'asc' for ascending or 'desc' for descending

            $query->whereHas('reviews', function ($query) use ($requestData, $order) {
                $query->select(DB::raw('user_id, count(*) as review_count'))
                    ->groupBy('user_id')
                    ->orderBy('review_count', $order);
            });
        }

        */
        // get the results with the necessary relationships
        $users = $query->with('detail.specs', 'reviews', 'votes')->get();




        // if no users were found, return an error message
        if (count($users) == 0) {
            return response()->json([
                'success' => false,
                'error' => 'No users found',
            ]);
        }

        // otherwise, return the users
        return response()->json([
            'success' => true,
            'results' => $users,
            'specs' => $specs,
            'reviews' => $reviews,
            'votes' => $votes
        ]);
    }
}
