<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use App\Models\ProfileInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $profileInfos = ProfileInfo::where('user_id', $user_id)->get();

        if(count($profileInfos) > 0 ) {
            $profileInfoItem = $profileInfos[0];
        } else {
            $profileInfoItem = false;
        };

        return view('admin.profile-infos.index', compact('profileInfoItem'));
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
     * @param  \App\Models\ProfileInfo  $profileInfo
     * @return \Illuminate\Http\Response
     */
    public function show(ProfileInfo $profileInfo)
    {
        dd('ciao');
        // $user_id = Auth::id();

        // $profileInfos = ProfileInfo::where('user_id', $user_id)->get();

        // if(count($profileInfos) > 0 ) {
        //     $profileInfoItem = $profileInfos[0];
        // } else {
        //     $profileInfoItem = false;
        // };

        return view('admin.profile-infos.show', compact('profileInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfileInfo  $profileInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfileInfo $profileInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProfileInfo  $profileInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProfileInfo $profileInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfileInfo  $profileInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfileInfo $profileInfo)
    {
        //
    }
}
