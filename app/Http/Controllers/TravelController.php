<?php

namespace App\Http\Controllers;

use View;
use App\Models\Travel;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Classes\FormatResponse; 

class TravelController extends FormatResponse
{

    public function createTravel(Request $request){ 
        $travel = new Travel(); 
        $travel->create($request->input())->save();
        $travel = Travel::orderBy('created_at','desc')->first();
        if($travel){
            return $this->toJson($this->estadoExitoso(),$travel); 
        }
        return $this->toJson($this->estadoOperacionFallida()); 
    } 

    public function createTravelXML(Request $request){

        $xml_data = $request->getContent();
        $xml = simplexml_load_string($xml_data);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        $request = new Request($array); 
        if ($array){
            $travel = new Travel(); 
            $travel->create($request->input())->save();
            $travel = Travel::orderBy('created_at','desc')->first();
            if($travel){
                return $this->toJson($this->estadoExitoso(),$travel); 
            }
            return $this->toJson($this->estadoOperacionFallida());   
        } 
        return $this->toJson($this->estadoOperacionFallida()); 
    }

    public function getTravel($id = null){ 
        if($id){
            $travel = Travel::where('id',$id)->first();  
        }else{
            $travel = Travel::get();
        }
        if($travel){
            return $this->toJson($this->estadoExitoso(),$travel);   
        }
        $travel = [];
        return $this->toJson($this->estadoExitoso(),$travel);     
    }

    public function getTravelFilters(Request $request){
        if ($request){
            $travel = Travel::email($request->get('email'))
                        ->date($request->get('date'))
                        ->country($request->get('country'))
                        ->city($request->get('city')) 
                        ->paginate(20);  
        }else{
            $travel = Travel::get();
        }
        return $this->toJson($this->estadoExitoso(),$travel);        
    }

    public function view(){ 
        $travels = Travel::select('clients.id','email_fk','clients.name','clients.lastname','cellphone','country','city','date')
                    ->join('clients','clients.email','travels.email_fk')
                    ->get(); 
        return View::make('journey', compact('travels'));
    }

    public function delete($id){ 
        $client = Client::where('id', $id)->first();
            
        //Delete all travels associate to the client
        $email = $client->email; 
        $travels = Travel::where('email_fk',$email)->get();
        foreach ($travels as  $travel) {  
            $travel->delete();
        } 
        $client->delete();
        $travels = Travel::select('clients.id','clients.email','clients.name','clients.lastname','cellphone','country','city','date')
                    ->join('clients','clients.email','travels.email_fk')
                    ->get(); 
        return View::make('journey', compact('travels'));
    }
    
}
