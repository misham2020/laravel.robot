<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayService;
use App\User;
use App\User_payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{

    public function __construct(User_payment $user_payment)
    {
        $mpay = new PayService($user_payment);
        $mpay->startpay();
    }
    public function create(User $user)
    {
        $users = $user->all();

        if ($users->isNotEmpty()) {
            return view('index', compact("users"));
        }

    }
    public function getOneUsersPayments(User_payment $user_payment)
    {
        $pays = $user_payment
            ->join('users as umade', 'users_payments.made_user_id', 'umade.id')
            ->join('users as ureceive', 'users_payments.receive_user_id', 'ureceive.id')
            ->whereRaw('users_payments.id =
                (select users_payments.id from users_payments WHERE users_payments.made_user_id = umade.id 
                limit 1)')->select( 'users_payments.*')->get();
          
            $data = Carbon::now();

        return $pays->isEmpty() ? redirect('/')->with('danger', 'Операции отсутствуют') :
            view('payments', compact("pays", "data"));
    }
    
}
