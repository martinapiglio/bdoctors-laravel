@extends('layouts.app')

@section('content')

<div class="container py-5 d-flex gap-3 justify-content-center">

    <h3 class="text-center">
        Ciao {{ $user->name }}, sei nella pagina di checkout. 
    <br>
        Hai scelto la sponsorizzazione {{ $sponsorship->name }}
    </h3>

    <a href="{{ route('admin.purchase')}}">purchase</a>

    <form method="post" action="/purchase">
    @csrf
        <!-- Add form fields for payment information 		here -->        
        <button type="submit">Submit Payment</button>
    </form>

</div>

<script>
    var clientToken = "{{ $clientToken }}";
    // Use the clientToken here...
</script>

@endsection