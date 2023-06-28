@extends('layouts.app')

@section('content')
<div class="show-cnt text-center p-5">

    @if($detail)

    <h2 class="pb-5">Il tuo profilo</h2>

    <div class="d-flex flex-wrap gap-5">
        <div id="profile-img">
            @if($detail->profile_pic) 
            <img id="profile-pic" src="{{ asset('storage/' . $detail->profile_pic) }}" alt="">
            @else
            <img class="__img-anonimo" src="{{ asset('images/anonimo.jpg') }}" alt="">
            @endif
        </div>
        
        <div class="generalita text-start">
            <div class="my-4">
                @if($detail->curriculum)
                <a href="{{ asset('storage/'. $detail->curriculum) }}" target="_blank" class="btn curriculum-btn">Mostra CV</a>
                <a href="{{ asset('storage/'. $detail->curriculum) }}" download="{{ $detail->slug . '-cv'}}" class="btn curriculum-btn">Download CV</a>
                @else
                <span> <i>Non hai aggiunto nessun curriculum. Per farlo, vai nella sezione di <a href="{{route('admin.details.edit', $detail->slug)}}">modifica profilo</a></button></i> </span>
                @endif
            </div>
            <div class="testo-ordinato">
                <div class="info-rows">
                    <strong>Nome:</strong> {{ $detail->user?->name }} <br>
                </div>
                <div class="info-rows">
                    <strong>Cognome:</strong> {{ $detail->user?->surname }} <br>
                </div>
                <div class="info-rows">
                    <strong>Indirizzo:</strong> {{ $detail->user?->address }} <br>
                </div>
                <div class="info-rows">
                    <strong>Descrizione:</strong> {{ $detail->user?->description }} <br>
                </div>
                <div class="info-rows">
                    <strong>Specializzazione principale:</strong> {{ $detail->user?->mainspec }}<br>
                </div>
                <div class="info-rows">
                    <strong>Specializzazioni aggiuntive:</strong> 
                    @if(count($detail->specs) > 0)
                    <ul>
                        @foreach($detail->specs as $spec)
                        <li>{{$spec->title}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="info-rows">
                    <strong>Prestazioni:</strong> {{ $detail->services }}    <br>
                </div>
                <div class="info-rows">
                    <strong>Email:</strong> {{ $detail->user?->email }} <br>
                </div>
                <div class="info-rows">
                    <strong>Numero di telefono:</strong> {{ $detail->phone_number }} <br>
                </div>
            @else  
            Unknown
            @endif 
            </div>
        </div>
       
    </div>
    
    <section id="charts-section" class="pt-5 pb-3 mt-5 mb-4">
        <h3>Le tue statistiche</h3>
        <div class="charts d-flex flex-wrap justify-content-center">
            <div class="p-5 chart">
                {!! $chartN1->container() !!}
            </div>
            <div class="p-5 chart">
                {!! $chartN2->container() !!}
            </div>
            <div class="p-5 chart">
                {!! $chartN3->container() !!}
            </div>
            
        </div>
        
    </section>

    <button class="me-3 edit-btn btn" type="submit"><a href="{{route('admin.details.edit', $detail->slug)}}">Modifica dati di profilo</a></button>

    {{-- modal --}}
    <button type="button" class="erase-btn btn" data-bs-toggle="modal" data-bs-target="#deleteProject">
        Cancella dati di profilo
    </button>

    <div class="modal fade text-dark" id="deleteProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella dati</h1>
                </div>

                <div class="modal-body">
                    Sei sicuro di voler cancellare questi dati? Se procedi, l'azione sarà irreversibile.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

                    <form action="{{route('admin.details.destroy', $detail->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger" type="submit">Cancella</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
    {{-- // modal --}}

    @else

        <div>
            non hai aggiunto ancora nulla
        </div>

    @endif

    <div class="my-4">
        <a href="{{ route('admin.dashboard') }}">Torna alla dashboard</a>
    </div>

</div>
{!! $chartN1->script() !!}
{!! $chartN2->script() !!}
{!! $chartN3->script() !!}


@endsection
