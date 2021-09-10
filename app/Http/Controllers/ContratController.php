<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;
use Exception;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function GetAllContractsFromClient($clientId){
        try {
            return Contrat::where('client_id', '=', $clientId)->get();
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function GetOneContractFromClient($contractId, $clientId){
        try {
            $contract = Contrat::findOrFail($contractId);
            if($contract->client_id != $clientId)
                throw new Exception("Le contrat demandé n'appartient pas au client fourni");

            return $contract;
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }

    public function UpdateContract(Request $request, $id){
        try {
            $contract = Contrat::findOrFail($id);

            if(!((new ClientController())->GetClientById((int) $request->client_id) instanceof Client)){
                throw new Exception("Le client n'a pas pu être trouvé.");
            }

            $contract->client_id  = $request->client_id;
            $contract->energy = $request->energy;
            $contract->product = $request->product;
            $contract->gsrn = $request->gsrn;
            $contract->duration = $request->duration;
            $contract->codePromo = $request->codePromo;

            if($contract->save()){
                return response()->json(['status' => 'success', 'message' => 'Contrat mis à jour']);
            }
        }
        catch (Exception $exception){
            return response()->json(['status' => 'error', 'message' => $exception->getMessage()]);
        }
    }
}
