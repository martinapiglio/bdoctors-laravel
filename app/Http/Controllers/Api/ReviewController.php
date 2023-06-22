<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validation($request);
        $review = new Review();

        $review->user_id = $request->userId;
        $review->name = $request->name;
        $review->description = $request->description;
        
        $review->save();

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }

    private function validation($request) {

        $formData = $request->all(); 

        $validator = Validator::make($formData, [
            'name' => 'min:3|max:50',
            'description' => 'required|min:3|max:500',            
        ], [            
            'name.min' => "Il nome deve essere di almeno 3 caratteri.",
            'name.max' => "Il nome non può essere più lungo di 50 caratteri.",
            'description.required' => "La recensione è obbligatoria",
            'description.min' => "La recensione deve essere di almeno 3 caratteri",
            'description.max' => "La recensione non può essere più lunga di 50 caratteri.",           

        ])->validate();

        return $validator;
    }
}
