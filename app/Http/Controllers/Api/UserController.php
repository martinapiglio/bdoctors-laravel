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

        if ($request->has('vote') && $requestData['vote'] != "" && $request->has('mainspec') && $requestData['mainspec'] != "") {
            $query->whereHas('votes', function ($query) use ($requestData) {
                $query->select(DB::raw('user_id'))
                    ->groupBy('user_id')
                    ->havingRaw('AVG(vote) >= ?', [$requestData['vote']]);
            })
                ->where('mainspec', $requestData['mainspec'])
                ->orWhereHas('detail.specs', function ($query) use ($requestData) {
                    $query->where('specs.title', $requestData['mainspec']);
                });
        }


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
            $query->where(function ($query) use ($requestData) {
                $query->where('mainspec', $requestData['mainspec'])
                    ->orWhereHas('detail.specs', function ($query) use ($requestData) {
                        $query->where('specs.title', $requestData['mainspec']);
                    });
            });
        }

        // if vote is present, add it to the query
        if ($request->has('vote') && $requestData['vote'] != "") {
            $query->whereHas('votes', function ($query) use ($requestData) {
                $query->select(DB::raw('user_id'))
                    ->groupBy('user_id')
                    ->havingRaw('AVG(vote) >= ?', [$requestData['vote']]);
            });
        }

        // if order is present add it to the query
        // if ($request->has('order') && $requestData['order'] != "") {
        //     $query->select('users.*', DB::raw('(SELECT COUNT(*) FROM reviews WHERE reviews.user_id = users.id) AS reviews_count'))
        //         ->orderBy('reviews_count', $requestData['order']);
        // }

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
