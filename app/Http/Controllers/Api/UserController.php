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
    public function index(Request $request) {
        // return all the Projects in the database
	    // $projects = Project::all();
	    $requestData = $request->all();

        $users = User::all();
        // $details = Detail::all();
        $specs = Spec::all();

        // $sponsorships = Sponsorship::all();
        // $messages = Message::all();
        // $reviews = Review::all();
        // $votes = Vote::all();
        
        // I check if there is a parameter type_id in the request and that is 	not null
        // if ($request->has('type_id') && $requestData['type_id']) {
            //     $projects = Project::where('type_id', $requestData['type_id'])
            // 	    ->with('type', 'technologies')
            //         ->orderBy('projects.created_at', 'desc')
            //         ->paginate(2);
            
            if (count($users) == 0) {
                
                return response()->json([
                    'success' => false,
                    'error' => 'No users found',
                ]);
                
            } else {
                // here we are using the with method to eager load the type of the project 	 and the technologies of the project
                // and then we are ordering them by the date of creation of the project
                $users = DB::table('users')
                    ->leftJoin('details', 'users.slug', '=', 'details.slug')
                    ->leftJoin('detail_spec', 'details.id', '=', 'detail_spec.detail_id')
                    ->leftJoin('specs', 'specs.id', '=', 'detail_spec.spec_id' )
                    ->select('users.*', 'details.*', 'specs.*')
                    ->get();
                
            // $users = User::with('detail')->get();
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
