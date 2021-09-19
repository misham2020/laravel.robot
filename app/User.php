<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'total',
    ];

     public function userTransactions()
    {
        return $this->hasMany(UserTransaction::class, 'made_user_id', 'id');
    }

    public function toUserTransactions()
    {
        return $this->hasMany(UserTransaction::class, 'receive_user_id', 'id');
    } 
}
