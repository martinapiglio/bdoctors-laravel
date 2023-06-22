@extends('layouts.app')

@section('content')
<div class="container py-5">

    @if($message != null)
    <h1>Il tuo messaggio</h1>
    <h4> Oggetto: {{ $message->subject }} </h4>
    <h6> Nome: {{ $message->name }}</h6>
    <h6> Email: {{ $message->email }}</h6>
    <p>{{ $message->message }}</p>

    @else
    <div>non hai messaggi</div>
    @endif

    <a href=" {{ route('admin.messages.index')}} ">Torna a tutti i messaggi</a>

</div>

@endsection