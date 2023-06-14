@extends('layouts.app')

@section('content')
<div class="container py-5">
    dashboard

    @if(!$detail)
    <div>
        <a href="{{route('admin.details.create', $user->slug)}}">crea i dati del tuo profilo(create)</a>
    </div>
    @else
    <div>
        <a href="{{route('admin.details.show', $detail->slug)}}">mostrare i dati del tuo profilo(show)</a><br>
        <a href="{{route('admin.details.edit', $detail->slug)}}">modificare i dati del tuo profilo(edit)</a><br>
        <a href="">eliminare i dati del tuo profilo(delete)</a>
    </div>
    @endif

</div>

@endsection