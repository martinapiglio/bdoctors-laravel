@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="mb-4">Payment Failed</h3>
    {{ $data['message'] }}
{{ $data['errors'] }}
<a href="{{ route('admin.dashboard') }}">Torna alla tua dashboard</a>

</div>

@endsection
