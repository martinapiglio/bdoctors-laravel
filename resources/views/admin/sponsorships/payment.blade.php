
@extends('layouts.app')

@section('content')
<div class="fine-pagamento-cnt py-5 d-flex flex-column justify-content-center align-items-center">
    <div class="primo-blocco fs-2 text-center">
        <p class="mb-4">Il pagamento è andato a buon fine!</p>
        <p>Grazie per esserti fatto sponsorizzare da noi!</p>
    </div>
    <div class="blocco-due w-100 mt-5 fs-3 d-flex justify-content-around flex-wrap">
        <a href="{{ route('admin.dashboard') }}">Torna alla tua area</a>
        <a href="{{ route("admin.sponsorships.index") }}">Torna alle sponsorizzazioni</a>
    </div>
</div>

@endsection
