@extends('layouts.app')

@section('content')

<div class="container my-5">

    <div>
      <h3>Le tue sponsorizzazioni</h3>
      @if ($user->detail->sponsorships == '')
      <div class="container py-5 d-flex gap-3 justify-content-center">
        @foreach($user->detail->sponsorships as $userSponsorship)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> {{ $userSponsorship->name }} </h5>
              <?php
              $dateString = strtotime($userSponsorship->pivot->end_date);

              $date = date('d/m', $dateString);
              $time = date('H:i', $dateString);
                ?>
              <p class="card-text"> La sponsorizzazione del tuo profilo durerà {{ $userSponsorship->duration }} ore
                  e terminerà il {{ $date }} alle {{ $time }}.</p>
            </div>
        </div>
        @endforeach
      </div>
      @else
      <div class="py-5">
        <i>non hai acquistato nessuna sponsorizzazione</i>
      </div>
      @endif
    </div>

    <div>
      <h3>Acquista una sponsorizzazione tra le disponibili</h3>
      <div class="container py-5 d-flex gap-3 justify-content-center">
        @foreach($sponsorships as $sponsorship)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> {{ $sponsorship->name }} </h5>
              <h6 class="card-subtitle mb-2 text-muted">Prezzo: {{ $sponsorship->price }} €</h6>
              <p class="card-text"> La sponsorizzazione del tuo profilo durerà {{ $sponsorship->duration }} ore</p>
              <a href="{{ route('admin.sponsorships.show', $sponsorship->slug) }}" class="btn btn-primary">Acquista</a>
            </div>
        </div>
        @endforeach
      </div>
    </div>

</div>

@endsection