@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="message-title mb-4">Messaggi</h3>

    @if(count($messages) > 0)

    <table class="table mb-3">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Oggetto</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
          <tr class="row-table">
            <td> {{ $message->name }} </td>
            <td> {{ $message->email }} </td>
            <td> {{ $message->subject }} </td>
            <td> <a href="{{route('admin.messages.show', $message)}}"> Apri messaggio </a> </td>
          </tr>
            @endforeach
        </tbody>
      </table>

    @else
    <div class="blue">non hai messaggi</div>
    @endif

    <div class="d-flex justify-content-center mt-4">
       <button class="btn btn-dark text-center"><a href="{{ route('admin.dashboard') }}">Torna alla Dashboard</a></button>
    </div>

</div>

@endsection