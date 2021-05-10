<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{ 
    protected $table = 'travels';

    protected $fillable = [
        'id', 'email_fk', 'date','country','city'
    ]; 

    public function scopeEmail($query, $email)
    {
        if (!is_null($email)) {
            return $query->where('email_fk', 'like', '%'.$email.'%');
        }
        return $query; 
    }
    public function scopeDate($query, $date)
    {
        if (!is_null($date)) {
            return $query->where('date', 'like', '%'.$date.'%');
        }
        return $query; 
    }
    public function scopeCountry($query, $country)
    {
        if (!is_null($country)) {
            return $query->where('country', 'like', '%'.$country.'%');
        }
        return $query; 
    }
    public function scopeCity($query, $city)
    {
        if (!is_null($city)) {
            return $query->where('city', 'like', '%'.$city.'%');
        }
        return $query; 
    }
}
