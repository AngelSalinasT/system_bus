<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'passengerName' => ['required', 'string', 'max:255'],
            'passengerEmail' => ['required', 'email', 'max:255', 'unique:tickets', 'string'],
            'seatNumber' => ['required', 'integer', 'min:1'],
            'busId' => ['required', 'exists:buses,id'],
            'userId' => ['required', 'exists:users,id'],
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'passengerName' => $this->passenger_name,
            'passengerEmail' => $this->passenger_email,
            'seatNumber' => $this->seat_number,
            'busId' => $this->bus_id,
            'userId' => $this->user_id
        ]);
    }
}
