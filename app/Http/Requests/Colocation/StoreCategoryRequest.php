<?php

namespace App\Http\Requests\Colocation;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userId = Auth::id();

        if (!$userId) return false;

        $membership = Membership::where('user_id', $userId)
            ->whereNull('left_at')
            ->first();

        return $membership && $membership->role === 'owner';
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
            'name' =>[
                'required',
                'string',
                'min:2',
                'max:50',

                Rule::unique('categories' , 'name')->where(function ($q) use($colocationId)
                {
                    return $q->where('colocation_id' , $colocationId);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'This category already exists in your colocation.',
        ];
    }
}
