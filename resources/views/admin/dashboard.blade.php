@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">dashboard</h3>

    @if(!$detail)
    <div>
        <a href="{{route('admin.details.create', $user->slug)}}">crea i dati del tuo profilo</a>
    </div>
    @else
    <div>
        <a href="{{route('admin.details.show', $detail->slug)}}">mostra i dati del tuo profilo</a><br>
        <a href="{{route('admin.details.edit', $detail->slug)}}">modifica i dati del tuo profilo</a><br>
        <a href="{{route('admin.messages.index', $detail->slug)}}">Vedi i tuoi messaggi</a><br>
        <a href="{{route('admin.reviews.index', $detail->slug)}}">vedi le tue recensioni</a><br>
        <a href="{{route('admin.votes.index', $detail->slug)}}">vedi i tuoi voti</a><br>
    </div>
    
    <div>
        <a href="{{route('admin.sponsorships.index')}}">Vai alle sponsorizzazioni</a>
    </div>
    @endif
</div>

@endsection