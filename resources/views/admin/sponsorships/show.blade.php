@extends('layouts.app')

@section('content')

<div id="sfondo-pay">

    <div class="py-5 container"></div>

    <h3 class="text-center">
        Ciao {{ $user->name }}, sei nella pagina di checkout. 
    <br>
        Hai scelto la sponsorizzazione <i>{{ $sponsorship->name }}</i>
    </h3>

    <form class="container" method="post" action="{{ route('admin.sponsorships.store', $sponsorship->slug) }}">
    @csrf

        <h3 class="py-3">Pagamento</h3>

        <div class="payment-container">

            <label for="fname">Metodi di pagamento accettati: <b>MasterCard <i class="fa-brands fa-cc-mastercard"></i>, Visa <i class="fa-brands fa-cc-visa"></i>, PayPal <i class="fa-brands fa-cc-paypal"></i></b></label>
    
            <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
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