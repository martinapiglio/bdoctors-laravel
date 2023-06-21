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
    public function show($slug)
    {
        // we are using the where method to find the user with the slug parameter in the database
        $user = User::where('slug', $slug)->with('detail.specs', 'reviews', 'votes')->first();
        // the same as doing:
        // 'SELECT * FROM users WHERE slug = $slug'

        if ($user) {
            // we return the user in json format with the success message
            return response()->json([
                'success' => true,
                'user' => $user,
            ]);
        } else {
            // if the user is not found we return an error message in json format with the success message set to false
            return response()->json([
                'success' => false,
                'error' => 'The user does not exist',
            ]);
        }
    }
}
