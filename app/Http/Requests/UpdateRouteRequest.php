<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
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
                'routeName' => ['required'],
                'origin' => ['required'],
                'destination' => ['required'],
                'distance' => ['required'],
                'estimatedTime' => ['required'],
                'branchId' => ['required', 'exists:branches,id'],
            ];
        }else{
            return [
                'routeName' => ['sometimes', 'required'],
                'origin' => ['sometimes', 'required'],
                'destination' => ['sometimes', 'required'],
                'distance' => ['sometimes', 'required'],
                'estimatedTime' => ['sometimes', 'required'],
                'branchId' => ['sometimes', 'required', 'exists:branches,id'],
            ];
        }
    }
    protected function prepareForValidation(){
        $this->merge([
            'routeName' => $this->route_name,
            'estimatedTime' => $this->estimated_time,
            'branchId' => $this->branch_id
        ]);
    }
}
