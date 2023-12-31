<section>
    <header>
        <h2 class="text-secondary">
            {{ __('Informazioni di profilo') }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __("Modifica le tue informazioni di profilo e l'indirizzo email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-2">
            <label for="name">Nome *</label>
            <input class="form-control" type="text" name="name" id="name" autocomplete="name" value="{{old('name', $user->name)}}" required autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('name')}}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="surname">Cognome *</label>
            <input class="form-control" type="text" name="surname" id="surname" autocomplete="surname" value="{{old('surname', $user->surname)}}" required autofocus>
            @error('surname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('name')}}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="email">
                {{__('Email *') }}
            </label>

            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email)}}" required autocomplete="username" />

            @error('email')
            <span class="alert alert-danger mt-2" role="alert">
                <strong>{{ $errors->get('email')}}</strong>
            </span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-muted">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="btn btn-outline-dark">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-success">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        {{-- address --}}
        <div class="mb-2">
            <label for="address">{{__('Indirizzo *')}}</label>
            <input class="form-control" type="text" name="address" id="address" autocomplete="address" value="{{old('address', $user->address)}}" required autofocus>
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('address')}}</strong>
            </span>
            @enderror
        </div>

        {{-- description --}}
        <div class="input-group mb-3">
            <label for="description">Descrizione *</label>
            <textarea class="mx-3 form-control @error('description') is-invalid @enderror" id="description" name="description" required minlength="3" maxlength="500">{{old('description') ?? $user->description }}</textarea>
                        
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- specs --}}
        <div class="input-group mb-3">
            Specializzazione principale *:

            @foreach($specs as $spec)
                <div class="form-check">
                    <input type="radio" id="spec-{{$spec->id}}" name="mainspec" value="{{ $spec->title }}" {{ (old('mainspec', $user->mainspec) == $spec->title) ? 'checked' : '' }}>
                    <label for="spec-{{$spec->id}}">{{$spec->title}}</label>
                </div>
            @endforeach
            
            @error('mainspec')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="text-center mb-4">I campi contrassegnati con * sono obbligatori.</div>

        <div class="d-flex align-items-center gap-4">
            <button class="btn btn-primary" type="submit">{{ __('Salva') }}</button>

            @if (session('status') === 'profile-updated')
            <script>
                const show = true;
                setTimeout(() => show = false, 2000)
                const el = document.getElementById('profile-status')
                if (show) {
                    el.style.display = 'block';
                }
            </script>
            <p id='profile-status' class="fs-5 text-muted">{{ __('Modifiche salvate.') }}</p>
            @endif
        </div>
    </form>
</section>
