@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Recensioni</h3>

    @if(count($reviews) > 0)
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Recensione</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
          <tr>
            <td> {{ $review->name }} </td>
            <td> {{ $review->description }} </td>
            <td> <a href="{{route('admin.reviews.show', $review)}}"> Apri recensione </a> </td>
          </tr>
            @endforeach
        </tbody>
      </table>
      
    @else
    <div>non hai recensioni</div>
    @endif


</div>

@endsection