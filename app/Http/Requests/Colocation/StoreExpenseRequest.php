<?php

namespace App\Http\Requests\Colocation;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = Auth::id();

        if (!$userId) return false;


        return Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::id();

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        $colocationId = $membership?->colocation_id;

        return [
            'title' => ['required', 'string', 'min:2', 'max:120'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'date' => ['required', 'date'],

            'category_id' => [
                'nullable',
                'integer',

                Rule::exists('categories', 'id')->where(function ($q) use ($colocationId) {
                    return $q->where('colocation_id', $colocationId);
                }),
            ],

            'payer_id' => [
                'required',
                'integer',
                Rule::exists('memberships', 'user_id')->where(function ($q) use ($colocationId) {
                    return $q->where('colocation_id', $colocationId)->whereNull('left_at');
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'payer_id.exists' => 'Selected payer must be an active member in your colocation.',
            'category_id.exists' => 'Selected category is not valid for your colocation.',
        ];
    }
}
