@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrati') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- name --}}
                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome *') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required minlength="3" maxlength="50" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- surname --}}
                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required minlength="3" maxlength="50" autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- address --}}
                        <div class="mb-4 row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo *') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required minlength="3" maxlength="100" autocomplete="address" autofocus>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- description --}}
                        <div class="mb-4 row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrizione *') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required minlength="3" maxlength="500">{{ old('description') }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- spec --}}
                        <div class="mb-4 row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Specializzazione *') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required>{{ old('description') }}</textarea>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-mail *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required minlength="3" maxlength="500" autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- password --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="8" maxlength="255"  autocomplete="new-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- confirm password --}}
                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                        </div>

                        <div class="text-center mb-4">I campi contrassegnati con * sono obbligatori.</div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // let password = document.getElementById("password")
    // let pswConfirmed = document.getElementById("password-confirm");
    
    // function checkPswChar() {

    //     const pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;

    //     if (!pattern.test(password.value)) {
    //         password.setCustomValidity("La password non è valida, deve contenere almeno 8 caratteri di cui una minuscola, una maiuscola, un carattere speciale.");
    //     } else {
    //         password.setCustomValidity('');
    //     }
    // }
    
    // password.oninput = checkPswChar;
    // password.onkeyup = checkPswChar;

    // function validatePassword(){
    //     if(password.value != pswConfirmed.value) {
    //         pswConfirmed.setCustomValidity("Le password non coincidono");
    //     } else {
    //         pswConfirmed.setCustomValidity('');
    //     }
    // }

    // password.onchange = validatePassword;
    // pswConfirmed.onkeyup = validatePassword;
</script>
@endsection
