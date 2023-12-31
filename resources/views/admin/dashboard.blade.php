@extends('layouts.app')

@section('content')
<div class="dashboard-cnt">

    @if(!$detail)
    <div class="welc-cont container d-flex justify-content-center align-items-center">
        <h1 class="text-uppercase text-center">
            <a id="welcome-ref" href="{{route('admin.details.create', $user->slug)}}">Ciao {{ $user->name }},<br>ci siamo quasi, arricchisci il tuo profilo!</a>
        </h1>
    </div>
    @else
        <div class="sub-nav">
            <div class="primi-link d-none d-md-flex p-3 justify-content-center gap-5 align-items-center flex-wrap">
                <a href="{{route('admin.details.show', $detail->slug)}}">Mostra i dati del tuo profilo</a>
                <a href="{{route('admin.details.edit', $detail->slug)}}">Modifica i dati del tuo profilo</a>
                <a href="{{route('admin.messages.index', $detail->slug)}}">Messaggi</a>
                <a href="{{route('admin.reviews.index', $detail->slug)}}">Recensioni</a>
                <a href="{{route('admin.votes.index', $detail->slug)}}">Voti</a>
                <a href="{{route('admin.sponsorships.index')}}">Sponsorizzazioni</a>
            </div>
            <div class="d-flex d-md-none justify-content-center p-3 align-items-center dropdown">
                <button class="sub-nav-btn btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Menu
                </button>
                <ul class="drop-list dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('admin.details.show', $detail->slug)}}">Mostra i dati del tuo profilo</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.details.edit', $detail->slug)}}">Modifica i dati del tuo profilo</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.messages.index', $detail->slug)}}">Messaggi</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.reviews.index', $detail->slug)}}">Recensioni</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.votes.index', $detail->slug)}}">Voti</a></li>
                  <li><a class="dropdown-item" href="{{route('admin.sponsorships.index')}}">Sponsorizzazioni</a></li>
                </ul>
            </div>
        </div>

        <h1 class="text-hello text-center pt-5">Ciao {{$user->name}}</h1>
        <h4 class="text-hello text-center">Questa è la tua area personale, qui puoi gestire il tuo profilo.</h4>
        <div class="main-sec container d-flex justify-content-center align-items-center gap-5 py-5">
            <div class="jumbo-cont">
                <img src="{{ asset("images/dottorireal.jpg") }}" alt="dottorini">
            </div>
            
            <div class="dash-reminders d-flex flex-column justify-content-center flex-wrap gap-4">
                <div>
                    <h5>Aiuta il tuo profilo a rimanere in primo piano</h5>
                    <a href="{{route('admin.sponsorships.index')}}">Scegli un piano di sponsorizzazioni</a>
                </div>
    
                <div>
                    <h5>Monitora sempre chi ha bisogno di te</h5>
                    <a href="{{route('admin.messages.index', $detail->slug)}}">Visualizza i tuoi messaggi</a>  
                </div>
    
                <div>
                    <h5>Tieni sempre in considerazione l'opinione dei tuoi pazienti</h5>
                    <a href="{{route('admin.reviews.index', $detail->slug)}}">Visualizza le tue recensioni</a>   
                </div>

                <div>
                    <h5>Il giudizio dei tuoi pazienti è molto importante</h5>
                    <a href="{{route('admin.votes.index', $detail->slug)}}">Visualizza i tuoi voti</a>
                </div>
            </div>
        </div>

    @endif

</div>

@endsection