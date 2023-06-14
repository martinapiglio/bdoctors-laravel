@extends('layouts.app')

@section('content')
<div class="container py-5">

    @if($detail) 

    <div>
        <img src="{{ asset('storage/' . $detail->profile_pic) }}" alt=""> <br>
        Name: {{ $detail->user?->name }} <br>
        Surname: {{ $detail->user?->surname }} <br>
        Address: {{ $detail->user?->address }} <br>
        Description: {{ $detail->user?->description }} <br>
        Email: {{ $detail->user?->email }} <br>
        Telephone no: {{ $detail->phone_number }} <br>
        Services: {{ $detail->services }}    <br>
        Specs:         
        
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

    <a href="{{route('admin.details.edit', $detail->slug)}}">Modifica</a>

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