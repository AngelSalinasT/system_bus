<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
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
            'routeName' => ['required'],
            'origin' => ['required'],
            'destination' => ['required'],
            'distance' => ['required'],
            'estimatedTime' => ['required'],
            'branchId' => ['required', 'exists:branches,id'],
        ];
    }
    protected function prepareForValidation(){
        $this->merge([
            'routeName' => $this->route_name,
            'estimatedTime' => $this->estimated_time,
            'branchId' => $this->branch_id
        ]);
    }
}
