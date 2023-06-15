<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Spec;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $specs = Spec::all();
        return view('auth.register', compact('specs'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'email' => ['required', 'string', 'email', 'max:500', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [   
            'name.required' => 'Il nome è obbligatorio.',
            'name.max' => 'Il nome non può essere più lungo di 50 caratteri.',
            'surname.required' => 'Il cognome è obbligatorio.',
            'surname.max' => 'Il cognome non può essere più lungo di 50 caratteri.',
            'address.required' => "L'indirizzo è obbligatorio.",
            'address.max' => "L'indirizzo non può essere più lungo di 100 caratteri.",
            'description.required' => 'La descrizione è obbligatoria.',
            'description.max' => 'La descrizione non può essere più lunga di 500 caratteri.',
            'email.required' => "L'email è obbligatoria.",
            'email.email' => "L'email deve essere valida.",
            'email.max' => "L'email non può essere più lunga di 500 caratteri.",
            'password.required' => "La password è obbligatoria."
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'slug'=> strtolower($request->name) . '-' . strtolower($request->surname), 
            'address' => $request->address,
            'description' => $request->description,
            'mainspec' => $request->mainspec,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
