@extends('layouts.app')

@section('content')
<div class="container py-5">

    <form action=" {{ route('admin.details.update', $detail->slug) }} " method="POST" enctype="multipart/form-data" id="form">
        @csrf 
        @method('PUT')

        {{-- curriculum - FILE --}}
        <div class="input-group mb-3">
            <label for="curriculum">Curriculum</label>
            <input class="mx-3 form-control @error('curriculum') is-invalid @enderror" type="file" id="curriculum" name="curriculum" accept="application/pdf">
            
            @error('curriculum')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- profile_pic - FILE --}}
        <div class="input-group mb-3">
            <label for="profile_pic">Foto profilo</label>
            <input class="mx-3 form-control @error('profile_pic') is-invalid @enderror" type="file" id="profile_pic" name="profile_pic" accept="image/*">
            
            @error('profile_pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- phone_number --}}
        <div class="input-group mb-3">
            <label for="phone_number">Numero di telefono</label>
            <input class="mx-3 form-control @error('phone_number') is-invalid @enderror" type="text" id="phone_number" name="phone_number" required minlength="10" maxlength="25" value="{{old('phone_number') ?? $detail->phone_number}}">
                            
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- services --}}
        <div class="input-group mb-3">
            <label for="services">Prestazioni</label>
            <textarea class="mx-3 form-control @error('services') is-invalid @enderror" id="services" name="services" required maxlength="500">{{old('services') ?? $detail->services }}</textarea>
                        
            @error('services')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- specs --}}
        <div class="input-group mb-3">
            Specializzazioni:
            
            @foreach($specs as $spec)
            <div class="form-check">
                @if($errors->any())
                    <input type="checkbox" id="spec-{{$spec->id}}" name="specs[]" value="{{$spec->id}}" @checked(in_array($spec->id, old('specs', [])))>
                @else
                    <input type="checkbox" id="spec-{{$spec->id}}" name="specs[]" value="{{$spec->id}}" @checked($detail->specs->contains($spec->id))>
                @endif
                    <label for="spec-{{$spec->id}}">{{$spec->title}}</label>
            </div>
            @endforeach
            
            @error('specs')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <button class="btn btn-dark" type="submit">Modifica</button>
    </form>
    
</div>

@endsection