<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($request);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $this->validateProvider($request);

        $response = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(
            ['email' => $response->getEmail()],
            ['password' => Str::password()]
        );
        $data = [
            $provider . '_id' => $response->getId(),
            'username' => $response->getNickname() ?? $response->getName() ?? $response->getEmail() // Prioritaskan username jika tersedia
        ];

        if ($user->wasRecentlyCreated) {
            $data['name'] = $response->getName() ?? $response->getNickname();

            event(new Registered($user));
        }

        $user->update($data);

        Auth::login($user, true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    protected function validateProvider(Request $request): array
    {
        return $this->getValidationFactory()->make(
            $request->route()->parameters(),
            ['provider' => 'in:facebook,google,github']
        )->validate();
    }
}
