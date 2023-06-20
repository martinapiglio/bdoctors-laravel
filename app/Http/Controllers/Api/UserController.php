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

        // $users = User::all();
        // $details = Detail::all();
        $specs = Spec::all();
        // $sponsorships = Sponsorship::all();
        // $messages = Message::all();
        // $reviews = Review::all();
        // $votes = Vote::all();

        // I check if there is a parameter type_id in the request and that is not null
        if ($request->has('mainspec') && $requestData['mainspec'] != "") {

            $users = User::where('mainspec', $requestData['mainspec'])
                ->orWhereRaw('detail.specs = ?', [$requestData['mainspec']])
                ->with('detail.specs')
                ->get();
              
            if (count($users) == 0) {

                return response()->json([
                    'success' => false,
                    'error' => 'No users found',
                ]);
            }

        } else {

            $users = User::with('detail.specs')->get();
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
            // 'reviews' => $reviews,
            // 'votes' => $votes
        ]);
    }
}
