@extends('layouts.app')

@section('content')
<div class="sponsorship-container">
  <div class="container py-5 text-white text-center">
  
      <div>
        <h3>Le tue sponsorizzazioni</h3>
        @if (count($user->detail->sponsorships) > 0)
        <div class="container py-5 d-flex gap-3 justify-content-center flex-wrap">
          @foreach($user->detail->sponsorships as $userSponsorship)

            <?php
            $dateString = strtotime($userSponsorship->pivot->end_date);

            $date = date('d/m', $dateString);
            $time = date('H:i', $dateString);
            ?>

          @if(date('d/m') >= $date && date('H:i') >= $time) 

          <div class="card card-custom" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> {{ $userSponsorship->name }} </h5>
              <p class="card-text"> La sponsorizzazione del tuo profilo è durata {{ $userSponsorship->duration }} ore
                ed è terminata il {{ $date }} alle {{ $time }}.</p>
            </div>
            <div class="pb-3 text-danger active-not-spons">LA PROMOZIONE E' SCADUTA</div>
          </div>
            
          @else 
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"> {{ $userSponsorship->name }} </h5>
              <p class="card-text"> La sponsorizzazione del tuo profilo durerà {{ $userSponsorship->duration }} ore
                  e terminerà il {{ $date }} alle {{ $time }}.</p>
            </div>
            <div class="pb-3 text-success active-not-spons">LA PROMOZIONE E' ATTIVA</div>
          </div>

          @endif

          @endforeach

        </div>
        @else
        <div class="py-5">
          <i>non hai acquistato nessuna sponsorizzazione</i>
        </div>  
        @endif
      </div>
  
      <div class="mt-5">
        <h3>Acquista una sponsorizzazione tra le disponibili</h3>
        <div class="container py-5 d-flex gap-3 justify-content-center flex-wrap">
          @foreach($sponsorships as $sponsorship)
          <div id="card-{{$sponsorship->name}}" class="card" style="width: 18rem; min-height:190px;">
              <div class="card-body">
                <h5 class="{{$sponsorship->name}}" class="card-title"> {{ $sponsorship->name }} </h5>
                <h6 class="card-subtitle mb-2 text-muted">Prezzo: {{ $sponsorship->price }} €</h6>
                <p class="card-text"> La sponsorizzazione del tuo profilo durerà {{ $sponsorship->duration }} ore</p>
                <a href="{{ route('admin.sponsorships.show', $sponsorship->slug) }}" id="btn-{{$sponsorship->name}}" class="btn-buy btn btn-primary">Acquista</a>
              </div>
          </div>
          @endforeach
        </div>
      </div>
      <a class="text-uppercase" href="{{ route('admin.dashboard') }}">Torna alla Dashboard</a>
  
  </div>
</div>

@endsection