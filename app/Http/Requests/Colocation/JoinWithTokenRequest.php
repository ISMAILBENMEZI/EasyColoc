<?php

namespace App\Http\Requests\Colocation;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;

class JoinWithTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = $this->user()?->id;
        if (!$userId) return false;

        $hasActive = Membership::where('user_id', $userId)->whereNull('left_at')->exists();
        return ! $hasActive;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'token.required' => 'Please enter the invitation token.',
        ];
    }
}
