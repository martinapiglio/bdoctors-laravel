@extends('layouts.app')

@section('content')

<div id="sfondo-pay">

    <div class="py-5 container"></div>

    <h3 class="text-center">
        Ciao {{ $user->name }}, sei nella pagina di checkout. 
    <br>
        Hai scelto la sponsorizzazione <span>{{ $sponsorship->name }}</span>
    </h3>

    <form class="container" method="post" action="{{ route('admin.sponsorships.store', $sponsorship->slug) }}">
    @csrf

        <h3 class="py-3">Pagamento</h3>

        <div class="payment-container">

            <label for="fname">Metodi di pagamento accettati: </label>
    
            <div id="div-icone" class="icon-container">
                <i class="fa-brands fa-cc-mastercard" style="color:white; font-size:2.3em"></i>
                <i class="fa-brands fa-cc-visa" style="color:white"></i>
                <i class="fa-brands fa-cc-amex" style="color:white;"></i>
                <i class="fa-brands fa-cc-paypal" style="color:white"></i>
                <i class="fa-brands fa-cc-discover" style="color:white;"></i>
            </div>

            <label>Importo: <b>{{ $sponsorship->price }} €</b> </label>
    
                <div class="form-input-container mb-3">
                    <label for="cname">Nome sulla carta</label>
                    <input type="text" id="cname" name="cardname" required minlength="3">
                </div>
    
                <div class="form-input-container mb-3">
                    <label for="ccnum">Numero della carta</label>
                    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                </div>
    
                <div class="form-input-container mb-3">
                    <label for="expmonth">Scadenza</label>
                    <input type="text" id="expmonth" name="expmonth" type="month" minlength="7" maxlength="7" placeholder="2025-09" required>
                </div>
    
                <div class="form-input-container mb-3">
                    <label for="cvv">CVV</label>
                    <input type="number" id="cvv" name="cvv" placeholder="123" min="100" max="999" required>
                </div>
    
            <button class="btn procedi" type="submit">Procedi al pagamento</button>
            <button class="btn annulla" type="submit"><a href="{{route('admin.dashboard')}}">Annulla pagamento</a> </button>
        </div>

    </form>

</div>

<script>
    var clientToken = "{{ $clientToken }}";
    // Use the clientToken here...

</script>

@endsection