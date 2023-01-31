<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

date_default_timezone_set('Asia/Jakarta');

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        // Google user object dari google
        $userFromGoogle = Socialite::driver('google')->user();

        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('email', $userFromGoogle->getEmail())->first();

        // Jika tidak ada user, maka buat user baru
        if (!$userFromDatabase) {
            $newUser = User::create([
                'name' => $userFromGoogle->getName(),
                'email' => $userFromGoogle->getEmail(),
                'email_verified_at' => date('Y-m-d H:i:s'),
                'role' => 'user',
                'password' => null,
                'provider_id' => $userFromGoogle->getId(),
                'provider' => $provider,
            ]);

            // Login user yang baru dibuat
            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('user.index');
        } else {
            // Jika ada user langsung login saja
            if (User::where('provider_id', null)) {
                $updateUser = User::where('email', $userFromGoogle->getEmail())->update([
                    'provider_id' => $userFromGoogle->getId(),
                    'provider' => $provider,
                ]);
                if (User::where('role', 'admin')) {
                    auth('web')->login($userFromDatabase);
                    session()->regenerate();
                    return redirect()->route('admin.index');
                } else {
                    auth('web')->login($userFromDatabase);
                    session()->regenerate();
                    return redirect()->route('user.index');
                }
            } else {
                if (User::where('role', 'admin')) {
                    auth('web')->login($userFromDatabase);
                    session()->regenerate();
                    return redirect()->route('admin.index');
                } else {
                    auth('web')->login($userFromDatabase);
                    session()->regenerate();
                    return redirect()->route('user.index');
                }
            }
        }
    }
}
