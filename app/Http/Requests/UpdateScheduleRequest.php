<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
        $method = $this->method();
        if ($method == 'PUT') {
            return [
                'routeId' => ['required', 'exists:routes,id'],
                'busId' => ['required', 'exists:buses,id'],
                'date' => ['required', 'date'],
                'departureTime' => ['required'],
                'arrivalTime' => ['nullable'],
            ];
        }else{
            return [
                'routeId' => ['sometimes', 'required', 'exists:routes,id'],
                'busId' => ['sometimes', 'required', 'exists:buses,id'],
                'date' => ['sometimes', 'required', 'date'],
                'departureTime' => ['sometimes', 'required'],
                'arrivalTime' => ['sometimes', 'nullable'],
            ];
        }
    }
    protected function prepareForValidation(){
        $this->merge([
            'routeId' => $this->route_id,
            'busId' => $this->bus_id,
            'departureTime' => $this->departure_time,
            'arrivalTime' => $this->arrival_time
        ]);
    }
}
