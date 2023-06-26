@extends('layouts.app')

@section('content')
<div class="container py-5">

    @if($detail)

    <div>
        @if($detail->profile_pic)
        <img src="{{ asset('storage/' . $detail->profile_pic) }}" alt="">
        @else
        <img class="__img-anonimo" src="{{ asset('storage/profile_pic_folder/anonimo.jpg') }}" alt="">
        @endif

        <br>

        <div class="my-4">
            @if($detail->curriculum)
            <a href="{{ asset('storage/'. $detail->curriculum) }}" target="_blank" class="btn btn-primary">Mostra CV</a>
            <a href="{{ asset('storage/'. $detail->curriculum) }}" download="{{ $detail->slug . '-cv'}}" class="btn btn-primary">Download CV</a>
            @else
            <span> <i>Non hai aggiunto nessun curriculum. Per farlo, vai nella sezione di <a href="{{route('admin.details.edit', $detail->slug)}}">modifica profilo</a></button></i> </span>
            @endif
        </div>

        <strong>Nome:</strong> {{ $detail->user?->name }} <br>
        <strong>Cognome:</strong> {{ $detail->user?->surname }} <br>
        <strong>Indirizzo:</strong> {{ $detail->user?->address }} <br>
        <strong>Descrizione:</strong> {{ $detail->user?->description }} <br>
        <strong>Email:</strong> {{ $detail->user?->email }} <br>
        <strong>Numero di telefono:</strong> {{ $detail->phone_number }} <br>
        <strong>Prestazioni:</strong> {{ $detail->services }}    <br>
        <strong>Specializzazione principale:</strong> {{ $detail->user?->mainspec }}<br>
        <strong>Specializzazioni aggiuntive:</strong>

        @if(count($detail->specs) > 0)
            <ul>
                @foreach($detail->specs as $spec)
                <li>{{$spec->title}}</li>
                @endforeach
            </ul>

        @else
        Unknown
        @endif
        <div class="p-5">
            {!! $chartN1->container() !!}
        </div>
        <div class="p-5">
            {!! $chartN2->container() !!}
        </div>

    </div>

    <button class="btn btn-dark" type="submit"><a href="{{route('admin.details.edit', $detail->slug)}}">Modifica</a></button>

    {{-- modal --}}
    <button type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteProject">
        Cancella
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


@endsection
