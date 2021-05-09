<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;   

class ClientController extends FormatResponse
{

    public function createClient(Request $request){ 
            $client = new Client(); 
            $client->create($request->input())->save();
            $client = Client::orderBy('created_at','desc')->first();
            if($client){
                return $this->toJson($this->estadoExitoso(),$client); 
            }
            return $this->toJson($this->estadoOperacionFallida()); 
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
            $client = Client::where('status',1)->get();
        }
        if($client){
            return $this->toJson($this->estadoExitoso(),$client);   
        }
        $client = [];
        return $this->toJson($this->estadoExitoso(),$client);        
    }

    public function getClientFilters(Request $request){
        if ($request){
            $client = Client::select('*')->name($request->get('name'))
                        ->email($request->get('email'))
                        ->phone($request->get('phone'))
                        ->where('status',1)
                        ->paginate(20);  
        }else{
            $client = Client::where('status',1)->get();
        }
        return $this->toJson($this->estadoExitoso(),$client);        
    }

    public function deleteClient(Request $request){
        try {
            //Change Status from 1(active) to 0(inactive)
            $client = Client::where('id', $request->id)->first();
            $client->status = $request->status;
            $client->save();
            //Delete all travels associate to the client
            $email = $client->email; 
            $travels = Travel::where('email_fk',$email)->get();
            foreach ($travels as  $travel) { 
                $travel->status = 0;
                $travel->save();
            } 
            if($client){
                return $this->toJson($this->estadoExitoso());
            }
            return $this->toJson($this->estadoOperacionFallida());

        } catch (\Exception $ex) {
            return $this->toJson($this->estadoOperacionFallida($ex));
        }
    }


}
