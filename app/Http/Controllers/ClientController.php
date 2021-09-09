<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function GetAll(){
        return Client::all();
    }

    public function GetOneRandomly() : Client {
        $allClients = $this->GetAll();
        
        $clientsCount = $allClients->count();
        $randomClient = rand(0, $clientsCount - 1);

        return $allClients[$randomClient];
    }
}
