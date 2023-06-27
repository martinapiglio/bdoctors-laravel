@extends('layouts.app')

@section('content')
<div id="show-mess" class="container py-5">
    
    <h1>Il tuo messaggio</h1>
    <h4> Oggetto: {{ $message->subject }} </h4>
    <h6> Nome: <i>{{ $message->name }}</i></h6>
    <h6> Email: <i>{{ $message->email }}</i></h6>
    <p>{{ $message->message }}</p>


    <button class="btn"><a href=" {{ route('admin.messages.index')}} ">Torna a tutti i messaggi</a></button> 

</div>

@endsection