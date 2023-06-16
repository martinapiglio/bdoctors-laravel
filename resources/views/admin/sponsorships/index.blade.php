@extends('layouts.app')

@section('content')

<div class="container py-5 d-flex gap-3 justify-content-center">

    @foreach($sponsorships as $sponsorship)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title"> {{ $sponsorship->name }} </h5>
          <h6 class="card-subtitle mb-2 text-muted">Prezzo: {{ $sponsorship->price }} €</h6>
          <p class="card-text"> La sponsorizzazione del tuo profilo durerà {{ $sponsorship->duration }} ore </p>
          <a href="#" class="btn btn-primary">Acquista</a>
        </div>
    </div>
    @endforeach

</div>

@endsection