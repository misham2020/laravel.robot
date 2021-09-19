<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class User_payment extends Model
{
    protected $table = 'users_payments';

    protected $fillable = [
        'made_user_id',
        'receive_user_id',
        'amount',
        'flags_id',
        'transfer_time'
    ];
    public function flags()
    {
        return $this->belongsTo(Flag::class, 'flags_id', 'id');
    }

    public function madeUser()
    {
        return $this->belongsTo(User::class, 'made_user_id', 'id');
    }

    public function receiveUser()
    {
        return $this->belongsTo(User::class, 'receive_user_id', 'id');
    }
}
