@extends('layouts.app')

@section('content')
<div class="container py-5">
    
</div>show

    @if($detail) 

    <div>
        {{ $detail->slug }}
        {{ $detail->phone_number }}
        {{ $detail->user?->name }}
    </div>

    @else 

        <div>
            non hai aggiunto ancora nulla
        </div>
    
    @endif

@endsection