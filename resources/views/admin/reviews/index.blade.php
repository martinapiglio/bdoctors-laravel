@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="review-title mb-4">Recensioni</h3>

    @if(count($reviews) > 0)
    <table class="table mb-3">
        <thead>
          <tr>
            <th scope="col">Nome recensore</th>
            <th scope="col">Data della recensione</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
          <tr class="row-table">
            <td> {{ $review->name }} </td>
            <td> {{ date('d/m/Y H:i', strtotime($review->created_at)) }} </td>
            <td> <a href="{{route('admin.reviews.show', $review)}}"> Apri recensione </a> </td>
          </tr>
            @endforeach
        </tbody>
      </table>
      
    @else
    <div class="blue">non hai recensioni</div>
    @endif

    <div class="d-flex justify-content-center mt-4">
       <button class="btn btn-dark text-center"><a href="{{ route('admin.dashboard') }}">Torna alla Dashboard</a></button>
    </div>


</div>

@endsection