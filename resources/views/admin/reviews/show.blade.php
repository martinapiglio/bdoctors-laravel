@extends('layouts.app')

@section('content')
<div id="show-recensioni" class="container py-5 ">

    @if($review != null)
    <h1>La tua recensione</h1>
    <h6> Nome: <i>{{ $review->name }}</i></h6>
    <p>{{ $review->description }}</p>

    @else
    <div>non hai recensioni</div>
    @endif

    <button class="btn"><a href=" {{ route('admin.reviews.index')}} ">Torna a tutte le recensioni</a></button> 

</div>

@endsection