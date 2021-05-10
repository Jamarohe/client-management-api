<?php

namespace App\Http\Controllers;
use File;
use App\Models\Client;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Classes\FormatResponse;   

class ClientController extends FormatResponse
{

    public function createClient(Request $request){
        $client = new Client(); 
        if ($request->File('image')) {
            $file = public_path('images/users/');

            if (!(file_exists($file))) {
                $path = public_path('images/users/');
                File::makeDirectory($path, 0777, true, true);
            }

            $file = $request->file('image');
            $names = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/users', $names);
            $name = '/images/users/'.$names;
            $client->photo = '/images/users/'.$names;
        }
        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->cellphone = $request->cellphone;
        $client->email = $request->email;
        $client->address = $request->address;
        
        $client->save();
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
            $client = Client::get();
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
                        ->paginate(20);  
        }else{
            $client = Client::get();
        }
        return $this->toJson($this->estadoExitoso(),$client);        
    }

    public function deleteClient($id){
        try {
            //Search client and get id
            $client = Client::where('id', $id)->first();
            
            //Delete all travels associate to the client
            $email = $client->email; 
            $travels = Travel::where('email_fk',$email)->get();
            foreach ($travels as  $travel) { 
                $travel->status = 0;
                $travel->delete();
            } 
            $client->delete();
            if($client){
                return $this->toJson($this->estadoExitoso());
            }
            return $this->toJson($this->estadoOperacionFallida());

        } catch (\Exception $ex) {
            return $this->toJson($this->estadoOperacionFallida($ex));
        }
    }
 
}
