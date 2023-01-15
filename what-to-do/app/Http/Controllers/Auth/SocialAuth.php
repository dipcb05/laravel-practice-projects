<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Exception;
use Socialite;
use App\Models\User;


class SocialAuth extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function ProviderCallBack($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();
            $finduser = User::where('social_id', $user->id)
                            ->where('email', $user->email)
                            ->first();
            if($finduser)
            {
                Auth::login($finduser);
                DB::table('users_sessions')->insert([
                    'user_id' => $finduser->id,
                    'user_email' => $finduser->email,
                    'user_ip_address' => request()->ip(),
                    'login_status' => 'logged in',
                    'user_agent' => request()->header('User-Agent'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return redirect('/dashboard');
            }
            else
            {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->nickname,
                    'social_id'=> $user->id,
                    'auth_type'=> $provider,
                ]);

                $newUser->user_details()->create([
	                'profile_photo_path' => $user->avatar,
                ]);

                Auth::login($newUser);
                DB::table('users_sessions')->insert([
                    'user_id' => $newUser->id,
                    'user_email' => $newUser->email,
                    'user_ip_address' => request()->ip(),
                    'login_status' => 'logged in',
                    'user_agent' => request()->header('User-Agent'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                return redirect('/dashboard');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
