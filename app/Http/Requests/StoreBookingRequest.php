<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'selected_customer_id' => ['required', 'exists:users,id', function ($attribute, $value, $fail) {
                $user = User::findOrFail($value);
                if ($user->is_admin) {
                    $fail('The selected user is not a valid customer.');
                }
            }],
            'room_id' => ['required', 'exists:rooms,id'],
            'check_in_date' => ['required', 'date', 'after:yesterday'], // Ensures check-in is after today
            'check_out_date' => ['required', 'date', 'after:check_in_date'],  // Ensures check-out is after check-in
            'total_price' => ['required', 'numeric'], // Ensures positive price
            'total_adults' => ['required', 'numeric', 'min:1'], // Ensures at least 1 adult
            'total_children' => ['required', 'numeric', 'min:0'], // Allows optional children and minimum 0
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()->id,
        ]);
    }

    /**
     * Get custom validation messages (optional).
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.exists' => 'Please select a valid user.',
            'selected_customer_id.not_admin' => 'Only non-admin users can make bookings.',
            'room_id.exists' => 'Please select a valid room.',
            'check_in_date.after' => 'Check-in date must be after today.',
            'check_out_date.after' => 'Check-out date must be after check-in date.',
            'total_price.min' => 'Total price must be a positive value.',
            'total_adults.min' => 'There must be at least one adult for the booking.',
        ];
    }
}
