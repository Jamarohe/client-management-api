<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'id', 'name', 'lastname','cellphone','email','address','photo','status'
    ];
    protected $attributes = [
        'status' => 1, 
    ];

    public function scopeName($query, $name)
    {
        if (!is_null($name)) {
            return $query->where('name', 'like', '%'.$name.'%');
        }
        return $query; 
    }
    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('email', 'like', '%'.$email.'%');
        }
        return $query; 
    }
    public function scopePhone($query, $phone)
    {
        if (!is_null($phone)) {
            return $query->where('cellphone', 'like', '%'.$phone.'%');
        }
        return $query; 
    }
}
