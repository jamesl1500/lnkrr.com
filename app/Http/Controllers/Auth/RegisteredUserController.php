<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Console\Events\ScheduledBackgroundTaskFinished;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Lets get the image from imgs directory to save as blob in database
        $pic = base64_encode(file_get_contents(public_path('imgs/no_image_selected.png')));

        // Create user
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->url,
            'url' => $request->url,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_pic' => $pic ?? NULL,
            'background_pic' => $pic ?? NULL,
            'bio' => 'Welcome to my lnkrr page!',
            'font_family' => 'Arial',
            'bio_links' => serialize(array()),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect("/me");
    }
}
