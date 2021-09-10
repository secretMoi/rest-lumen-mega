<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function GetAll(){
        try {
            return Client::all();
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function GetClientById($id)
    {
        try {
            return Client::findOrFail($id);
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function GetOneRandomly() : Client {
        $allClients = $this->GetAll();

        $clientsCount = $allClients->count();
        $randomClient = rand(0, $clientsCount - 1);

        return $allClients[$randomClient];
    }

    public function SaveNewClient(Request $request){
        try {
            // check si email valide
            if(!filter_var($request->mail, FILTER_VALIDATE_EMAIL)){
                throw new Exception('Email invalide');
            }

            if(Client::where('mail', '=', $request->mail)->exists()){
                throw new Exception('Email déjà utilisée');
            }

            // check longueur du password
            if(strlen($request->password) < 6){
                throw new Exception('Mot de passe inférieur à 6 caractères');
            }

            $client = new Client();
            $client->firstName = $request->firstName;
            $client->lastName = $request->lastName;
            $client->mail = $request->mail;
            $client->password = app('hash')->make($request->password);
            $client->street = $request->street;
            $client->number = $request->number;
            $client->zip = $request->zip;
            $client->city = $request->city;

            if($client->save()){
                return response()->json(['status' => 'success', 'message' => 'Client créé']);
            }
        }
        catch (Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
