<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'contacts',
        'active'
    ];

    public function contact()
    {
        return $this->hasOne('App\Contact', 'person_id');
    }
    
    protected static function boot() {
        parent::boot();
    
        static::deleting(function($person) {
            $person->contact()->delete();
        });
    }
}
