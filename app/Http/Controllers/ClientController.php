<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;   

class ClientController extends Controller
{
    public function __construct()
    {
        
    }

    public function createClient(Request $request){
        try {
            $client = new client();
            $client->create($request->input())->save();
            $client = client::orderBy('created_at','desc')->first();
            if($client){
                return $this->toJson($this->estadoExitoso(),$client); 
            }
            return $this->toJson($this->estadoOperacionFallida()); 
        } catch (\Exception $ex) {
            return $this->toJson($this->estadoOperacionFallida());   
        }
    }

    public function updateClient(Request $request){
        try {
            $client = Client::where('id', $request->id)->first();
            $client->fill($request->input())->save();
            if($client){
                return $this->toJson($this->estadoExitoso(),$client);
            }
            return $this->toJson($this->estadoOperacionFallida());
        } catch (\Exception $ex) {
            return $this->toJson($this->estadoOperacionFallida());
        }
    }

    public function getClient($id = null){
        if($id){
            $client = Client::where('id',$id)->first();  
        }else{
            $client = Client::all();
        }
        if($client){
            return $this->toJson($this->estadoExitoso(),$client);   
        }
        $client = [];
        return $this->toJson($this->estadoExitoso(),$client);        
    }

    public function deleteClient(Request $request){
        try {
            $client = Client::where('id', $request->id)->first();
            $client->status = $request->status;
            $client->save();
            if($client){
                return $this->toJson($this->estadoExitoso(),$client);
            }
            return $this->toJson($this->estadoOperacionFallida());

        } catch (\Exception $ex) {
            return $this->toJson($this->estadoOperacionFallida($ex));
        }
    }


}
