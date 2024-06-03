<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'small_desc' => ['required'],
            'detail_desc' => ['required'],
            'filename' => [Rule::when(request()->isMethod('POST'), 'required'), Rule::when(request()->isMethod('PUT'), 'sometimes'),
                'image', 'mimes:jpg,jpeg,png,bmp', 'max:2048'],
        ];
    }
}
