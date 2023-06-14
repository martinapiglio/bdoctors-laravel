@extends('layouts.app')

@section('content')
<div class="container py-5">

    @if($detail) 

    <div>
        <img src="{{ asset('storage/' . $detail->profile_pic) }}" alt=""> <br>
        <strong>Nome:</strong> {{ $detail->user?->name }} <br>
        <strong>Cognome:</strong> {{ $detail->user?->surname }} <br>
        <strong>Indirizzo:</strong> {{ $detail->user?->address }} <br>
        <strong>Descrizione:</strong> {{ $detail->user?->description }} <br>
        <strong>Email:</strong> {{ $detail->user?->email }} <br>
        <strong>Numero di telefono:</strong> {{ $detail->phone_number }} <br>
        <strong>Prestazioni:</strong> {{ $detail->services }}    <br>
        <strong>Specializzazioni:</strong>         
        
        @if(count($detail->specs) > 0)
            <ul>
                @foreach($detail->specs as $spec)
                <li>{{$spec->title}}</li>
                @endforeach
            </ul>

        @else  
        Unknown
        @endif
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                </div>

                <div class="modal-body">
                    Do you want to delete the selected project? Please consider that this action is irreversible.
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                
                    <form action="{{route('admin.details.destroy', $detail->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                
                        <button class="btn btn-danger" type="submit">Delete</button>
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
    
</div>

@endsection