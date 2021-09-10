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
            $post = new Client();
            $post->firstName = $request->firstName;
            $post->lastName = $request->lastName;
            $post->mail = $request->mail;
            $post->password = app('hash')->make($request->password);
            $post->street = $request->street;
            $post->number = $request->number;
            $post->zip = $request->zip;
            $post->city = $request->city;

            if($post->save()){
                return response()->json(['status' => 'success', 'message' => 'Client créé']);
            }
        }
        catch (\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
