<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Socialite;
use App\FbInfo;
use App\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    private $fb_info;

    public function __construct(FbInfo $fb_info, User $user)
    {
        $this->fb_info = $fb_info;
        $this->user = $user;
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
            
            $fb_user = Socialite::driver('facebook')->user();
            
            // dd($this->user);

            if($fb_user){

                $this->search($fb_user);


                // OAuth Two Providers
                $token = $fb_user->token;
                $refreshToken = $fb_user->refreshToken; // not always provided
                $expiresIn = $fb_user->expiresIn;

                // All Providers
                $fb_user->getId();
                $fb_user->getNickname();
                $fb_user->getName();
                $fb_user->getEmail();
                $fb_user->getAvatar();

                return redirect("/");

            }
        }catch(Exception $e){
            return redirect("/");
        }

        // $fb_user->token;
    }

    public function register($data)
    {
        // $this->fb_info->timestamps = false;
        $this->fb_info->fill($data)->save();
    }

    // サーチして登録までするよ。あとでリファクタするよ…
    public function search($fb_user)
    {
        if(!$this->fb_info->where('fb_id', $fb_user->getId())->first()){
            $data = [
                'name' => $fb_user->getName(),
            ];
            $this->user->fill($data)->save();

            $data = [
                'user_id' => $this->user->id,
                'fb_id' => $fb_user->getId(),
                'fb_name' => $fb_user->getName(),
                'fb_avater' => $fb_user->getAvatar()
            ];

            $this->register($data);
        }
    }
}