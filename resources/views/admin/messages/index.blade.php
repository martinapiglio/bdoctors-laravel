@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Messaggi</h3>

    @if(count($messages) > 0)

    <table class="table">
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
          <tr>
            <td> {{ $message->name }} </td>
            <td> {{ $message->email }} </td>
            <td> {{ $message->subject }} </td>
            <td> <a href="{{route('admin.messages.show', $message)}}"> Apri messaggio </a> </td>
          </tr>
            @endforeach
        </tbody>
      </table>

    @else
    <div>non hai messaggi</div>
    @endif
</div>

@endsection