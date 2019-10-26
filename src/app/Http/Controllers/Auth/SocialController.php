<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Socialite;
use App\FbInfo;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    private $fb_info;

    public function __construct(FbInfo $fb_info)
    {
        $this->fb_info = $fb_info;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     * 
     * @return Response
     */
    public function viewLogin()
    {
        return view('auth.login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     * 
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     * 
     * @return Response 
     */
    public function handleFacebookProviderCallback()
    {
        try{
            
            $user = Socialite::driver('facebook')->user();
            // dd($user);

            if($user){

                $data = [
                    'id' => $user->getId(),
                    'fb_name' => $user->getName()
                ];

                $this->register($data);

                // OAuth Two Providers
                $token = $user->token;
                $refreshToken = $user->refreshToken; // not always provided
                $expiresIn = $user->expiresIn;

                // All Providers
                $user->getId();
                $user->getNickname();
                $user->getName();
                $user->getEmail();
                $user->getAvatar();

                return redirect("/");

            }
        }catch(Exception $e){
            return redirect("/");
        }

        // $user->token;
    }

    public function register($data)
    {
        $this->fb_info->timestamps = false;
        $this->fb_info->fill($data)->save();
    }
}