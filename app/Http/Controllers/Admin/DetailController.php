<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Detail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //take only authenticated user
        // $user_id = Auth::id();

        // $details = Detail::where('user_id', $user_id)->get();

        // if(count($details) > 0 ) {
        //     $detailItem = $details[0];
        // } else {
        //     $detailItem = false;
        // };

        // return view('admin.details.index', compact('detailItem'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail = Detail::where('user_id', Auth::id())->first();
        $user = User::where('id', Auth::id())->first();

        return view('admin.details.create', compact('detail', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        $formData = $request->all();

        // $this->validation($request);

        $newDetail = new Detail();

        // if($request->hasFile('thumbnail')){

        //     $path = Storage::put('project_img', $request->thumbnail);

        //     $formData['thumbnail'] = $path;
        // };
        
        $newDetail->fill($formData);
        $newDetail->slug = $user->slug;
        $newDetail->user_id = $user->id;

        $newDetail->save(); 

        // if(array_key_exists('technologies', $formData)){
        //     $newProject->technologies()->attach($formData['technologies']);
        // }

        return redirect()->route('admin.details.show', $newDetail->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        $detail = Detail::where('user_id', Auth::id())->first();

        return view('admin.details.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        return view('admin.details.edit', compact('detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        //
    }
}
