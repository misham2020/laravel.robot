<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'amount.required' => 'Сумма обязательна для заполнения',
            'amount.numeric' => 'Сумма должна быть числом',
            'amount.min' => 'Сумма платежа должна быть больше либо равно 1',
            'made.required' => 'Поле от кого обязательно для заполнения',
            'receive.required' => 'Поле для кого обязательно для заполнения',
            'date.date_format' => 'Неправильный формат даты',
            'made.different' => 'Себе перевести нельзя',
            'date.after' => 'Перевод в прошлое невозможен',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:1',
            'made' => 'required|exists:users,id|different:receive',
            'receive' => 'required|exists:users,id',
            'date' => 'required|date_format:"Y-m-d H:00:00"|after:now'
        ];
    }
}
