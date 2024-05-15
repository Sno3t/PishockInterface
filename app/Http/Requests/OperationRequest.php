<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'operation' => ['required', 'string'],
            'duration' => ['required', 'int','max:100'],
            'intensity' => ['string', 'max:100'],
        ];
    }
}
