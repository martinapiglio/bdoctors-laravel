<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Detail;
use App\Models\Spec;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $specs = Spec::all();

        return view('admin.details.create', compact('detail', 'user', 'specs'));
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

        $this->validation($request);

        $newDetail = new Detail();

        if($request->hasFile('profile_pic')){

            $path = Storage::put('profile_pic_folder', $request->profile_pic);

            $formData['profile_pic'] = $path;
        };
        
        if($request->hasFile('curriculum')){

            $path = Storage::put('curriculum_folder', $request->curriculum);

            $formData['curriculum'] = $path;
        };

        $newDetail->fill($formData);
        $newDetail->slug = $user->slug;
        $newDetail->user_id = $user->id;

        $newDetail->save(); 

        if(array_key_exists('specs', $formData)){
            $newDetail->specs()->attach($formData['specs']);
        }

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
        $specs = Spec::all();

        return view('admin.details.edit', compact('detail', 'specs'));
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
        $formData = $request->all();

        $this->validation($request);

        if($request->hasFile('profile_pic')){

            if($detail->profile_pic) {
                Storage::delete($detail->profile_pic);
            };

            $path = Storage::put('profile_pic_folder', $request->profile_pic);

            $formData['profile_pic'] = $path;
        };
        
        if($request->hasFile('curriculum')){

            if($detail->curriculum) {
                Storage::delete($detail->curriculum);
            };

            $path = Storage::put('curriculum_folder', $request->curriculum);

            $formData['curriculum'] = $path;
        };

        $detail->update($formData);

        if(array_key_exists('specs', $formData)){
            $detail->specs()->sync($formData['specs']);
        } else {
            $detail->specs()->detach();
        }

         return redirect()->route('admin.details.show', $detail->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        if($detail->profile_pic) {
            Storage::delete($detail->profile_pic);
        };

        if($detail->curriculum) {
            Storage::delete($detail->curriculum);
        };

        $detail->delete();

        return redirect()->route('admin.dashboard');
    }

    private function validation($request) {

        $formData = $request->all(); 

        $validator = Validator::make($formData, [
            'curriculum' => 'nullable|pdf|max:10240',
            'profile_pic' => 'nullable|image|max:4096',
            'phone_number' => 'nullable|max:50',
            'services' => 'nullable|max:500',
            'specs' => 'exists:specs,id'
        ], [
            'curriculum' => 'Curriculum must be a pdf file',
            'curriculum.max' => "Curriculum size exceeding 10MB, please try again.",
            'profile_pic.image' => "Profile picture must be an image file.",
            'profile_pic.max' => "Profile picture size exceeding 4MB, please try again.",
            'phone_number.max' => 'Phone number cannot be longer than 50 characters.',
            'services.max' => 'Services field cannot be longer than 500 characters.',
            'specs.exists' => 'Please select a specialization chosen among the existing ones',

        ])->validate();

        return $validator;
    }
}
