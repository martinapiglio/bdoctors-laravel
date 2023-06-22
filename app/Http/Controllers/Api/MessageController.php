<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
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

        $message = new Message();

        $message->user_id = $request->userId;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        
        $message->save();

        return response()->json(['success' => true]);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    private function validation($request) {

        $formData = $request->all(); 

        $validator = Validator::make($formData, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|min:3|max:500',
            'subject' => 'required|min:3|max:100',
            'message' => 'required|min:3|max:500',
        ], [
            'name.required' => 'Il nome è obbligatorio.',
            'name.min' => "Il nome deve essere di almeno 3 caratteri.",
            'name.max' => "Il nome non può essere più lungo di 50 caratteri.",
            'email.required' => "L'email è obbligatoria.",
            'email.min' => "L'email deve essere di almeno 3 caratteri.",
            'email.max' => "L'email non può essere più lunga di 500 caratteri.",
            'subject.required' => "L'oggetto della mail è obbligatorio.",
            'subject.min' => "L'oggetto della mail deve essere di almeno 3 caratteri.",
            'subject.max' => "L'oggetto della mail non può contenere più di 100 caratteri.",
            'message.required' => 'Il messaggio è obbligatorio.',
            'message.min' => 'Il messaggio deve essere di almeno 3 caratteri.',
            'message.max' => "Il messaggio non può contenere più di 500 caratteri.",

        ])->validate();

        return $validator;
    }
}

