@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h3 class="mb-5">
        Add new profile details
    </h3>

    <form action=" {{ route('admin.details.store') }} " method="POST" enctype="multipart/form-data">
        @csrf 

        {{-- curriculum - FILE --}}
        <div class="input-group mb-3">
            <label for="curriculum">Curriculum</label>
            <input class="mx-3 form-control @error('curriculum') is-invalid @enderror" type="file" id="curriculum" name="curriculum">
            
            @error('curriculum')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- profile_pic - FILE --}}
        <div class="input-group mb-3">
            <label for="profile_pic">Profile Picture</label>
            <input class="mx-3 form-control @error('profile_pic') is-invalid @enderror" type="file" id="profile_pic" name="profile_pic">
            
            @error('profile_pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- phone_number --}}
        <div class="input-group mb-3">
            <label for="phone_number">Phone number</label>
            <input class="mx-3 form-control @error('thumb') is-invalid @enderror" type="text" id="phone_number" name="phone_number" value="{{old('phone_number')}}">
                            
            @error('phone_number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- services --}}
        <div class="input-group mb-3">
            <label for="services">Services</label>
            <textarea class="mx-3 form-control @error('services') is-invalid @enderror" id="services" name="services" required>{{old('services')}}</textarea>
                        
            @error('services')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- specs --}}
        <div class="input-group mb-3">
            Specs:
            
            @foreach($specs as $spec)
                <div class="form-check">
                    <input type="checkbox" id="spec-{{$spec->id}}" name="specs[]" value="{{$spec->id}}" @checked(in_array($spec->id, old('specs', [])))>
                    <label for="spec-{{$spec->id}}">{{$spec->title}}</label>
                </div>
            @endforeach
            
            @error('specs')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <button class="btn btn-dark" type="submit">Add</button>
    </form>

</div>

@endsection