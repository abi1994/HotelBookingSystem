<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRegistrationRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => [Rule::when(request()->isMethod('POST'), 'required'), Rule::when(request()->isMethod('PUT'), 'sometimes')],
            'phone_number' => 'required',
            'address' => 'nullable',
            'filename' => ['image', 'mimes:jpg,jpeg,png,bmp', 'max:2048'],
        ];
    }
}
