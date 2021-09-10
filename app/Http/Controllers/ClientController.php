<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;

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
}
