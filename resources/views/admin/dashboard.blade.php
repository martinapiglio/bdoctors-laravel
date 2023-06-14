@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">dashboard</h3>

    @if(!$detail)
    <div>
        <a href="{{route('admin.details.create', $user->slug)}}">crea i dati del tuo profilo</a>
    </div>
    @else
    <div>
        <a href="{{route('admin.details.show', $detail->slug)}}">mostra i dati del tuo profilo</a><br>
        <a href="{{route('admin.details.edit', $detail->slug)}}">modifica i dati del tuo profilo</a><br>
    </div>
    @endif

</div>

@endsection