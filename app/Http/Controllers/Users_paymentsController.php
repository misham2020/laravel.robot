<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentsRequest;
use App\User;
use App\User_payment;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Users_paymentsController extends Controller
{
     /**
     * Метод сохранения транзакции в бд
     * @param PaymentsRequest $request
     */
    public function store(PaymentsRequest $request , User $user, User_payment $user_payment){

        $amount = $request->input('amount');
        $made = $request->input('made');
        $receive = $request->input('receive');
        $datePaymants = $request->input('date');

    try {
        DB::beginTransaction();

        $balance_check = $user_payment->where([['made_user_id', $made], ['flags_id', 3]])->sum('amount');

        $user_total = $user->find($made)->total - $balance_check;

        if ($user_total < $amount) {
            return redirect()->back()->with('danger', 'Недостаточно средств для перевода');
        }

        $user_payment->create([
            'made_user_id' => $made,
            'receive_user_id' => $receive,
            'transfer_time' => $datePaymants,
            'amount' => $amount,
            'flags_id' => 3
        ]);

        DB::commit();
        return redirect()->back()->with('success', "Запись была успешно добавлена.
      Запланированное время транзации {$datePaymants}");
    } 
catch (\Exception $exception) {
    Log::error($exception->getMessage());
    DB::rollBack();
} 
}
    public function pay(){

        $user_payments = User_payment::all();

        return view('payments' , compact("user_payments"));
    }
}
