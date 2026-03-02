<?php

namespace App\Http\Requests\Colocation;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreColocationRequest extends FormRequest
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
        $user = $this->user();

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::prohibitedIf(
                    Membership::where('user_id', $user->id)
                        ->whereNull('left_at')
                        ->exists()
                ),
            ],
            
        ];
    }

    public function messages()
    {
        return ['name.prohibited' => 'You already have an active colocation. Leave it before creating a new one.',];
    }
}
