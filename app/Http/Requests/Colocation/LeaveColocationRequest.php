<?php

namespace App\Http\Requests\Colocation;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;

class LeaveColocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if (!$user) {
            return false;
        }

        $membership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();
        if (!$membership) {
            return false;
        }

        if ($membership->role === 'owner') {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }

    public function messages()
    {
        return [
            'authorize' => 'You are not allowed to leave this colocation.',
        ];
    }
}
