@extends('layouts.app')

@section('content')
<div class="container py-5">

    @if($review != null)
    <h1>La tua recensione</h1>
    <h6> Nome: {{ $review->name }}</h6>
    <p>{{ $review->description }}</p>

    @else
    <div>non hai recensioni</div>
    @endif

    <a href=" {{ route('admin.reviews.index')}} ">Torna a tutte le recensioni</a>

</div>

@endsection