@extends('layouts.app')

@section('content')
<div class="dashboard-cnt">
    {{-- <h3 class="mb-4">dashboard</h3> --}}

    @if(!$detail)
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <h1 class="text-uppercase">
            <a href="{{route('admin.details.create', $user->slug)}}">completa il tuo profilo</a>
        </h1>
    </div>
    @else
        <div class="sub-nav d-flex justify-content-evenly align-items-center">
            <a href="{{route('admin.details.show', $detail->slug)}}">Mostra i dati del tuo profilo</a><br>
            <a href="{{route('admin.details.edit', $detail->slug)}}">Modifica i dati del tuo profilo</a><br>
            <a href="{{route('admin.messages.index', $detail->slug)}}">Vedi i tuoi messaggi</a><br>
            <a href="{{route('admin.reviews.index', $detail->slug)}}">Vedi le tue recensioni</a><br>
            <a href="{{route('admin.votes.index', $detail->slug)}}">Vedi i tuoi voti</a><br>
            <a href="{{route('admin.sponsorships.index')}}">Vai alle sponsorizzazioni</a>
        </div>
        <h1 class="text-hello text-center pt-5">Ciao {{$user->name}}</h1>
        <h4 class="text-hello text-center">questa è la tua area personale, qui puoi gestire il tuo profilo.</h4>
        <div class="main-sec container py-5">
            <div class="jumbo-cont w-100 d-flex justify-content-center">
                <img src="{{ asset("images/dottorireal.jpg") }}" alt="dottorini">
            </div>
        </div>
    @endif
</div>

@endsection