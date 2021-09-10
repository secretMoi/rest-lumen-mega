<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class AuthController extends Controller
{
    public function Login(Request $request){
        $email = $request->mail;
        $password = $request->password;

        if(empty($email) OR empty($password)){
            return response()->json(['status' => 'error', 'message' => 'Email ou mot de passe vide']);
        }

        $client = new Client();

        try {
            return $client->post(config('service.passport.login_endpoint'), [
                "form_params" => [
                    "client_secret" => config('service.passport.client_secret'),
                    "grant_type" => "password",
                    "client_id" => config('service.passport.client_id'),
                    "username" => $request->mail,
                    "password" => $request->password
                ]
            ]);
        }
        catch (BadRequestException $exception){
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ]);
        }
    }

    public function Register(Request $request){
        try {
            if((new ClientController())->SaveNewClient($request)->getData()->status == 'success'){
                return $this->login($request);
            }
            else{
                throw new Exception("Impossible d'enregister le nouveau client");
            }
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function Logout(){
        try {
            if(auth()->user() == null)
                throw new Exception("Vous n'êtes pas connecté");

            auth()->user()->tokens()->each(function ($token){
                $token->delete();
            });

            return response()->json(['status' => 'success', 'message' => 'Déconnexion réussie']);
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }
}
