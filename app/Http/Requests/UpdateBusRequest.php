<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
                'plates' => ['required', 'unique:buses,plates'],
                'model' => ['required'],
                'capacity' => ['required', 'min:1'],
            ];
        }else{
            return [
                'plates' => ['sometimes', 'required', 'unique:buses,plates'],
                'model' => ['sometimes', 'required'],
                'capacity' => ['sometimes', 'required', 'min:1'],
            ];
        }
    }
}
