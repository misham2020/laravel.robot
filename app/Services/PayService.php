<?php

namespace App\Services;

use App\User;
use App\User_payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PayService
{
    private $user_payment;

    public function __construct(User_payment $user_payment)
    {
        $this->user_payment = $user_payment;
    }
    public function startpay()
    {
        $madepay = $this->user_payment->where([
            ['flags_id', 3],
            ['transfer_time', '<=', Carbon::now()]
        ])->get();

        foreach ($madepay as $pay) {
            DB::beginTransaction();
            try {
                $madetotal = $pay->madeUser->total - $pay->amount;
                $receivetotal = $pay->receiveUser->total + $pay->amount;
                $pay->madeUser->update(['total' => $madetotal]);
                $pay->receiveUser->update(['total' => $receivetotal]);
                $pay->update(['flags_id' => 1]);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error("Транзакция не удалась {$exception->getMessage()}");
                $pay->update(['flags_id' => 2]);
            }
        }
    }
}