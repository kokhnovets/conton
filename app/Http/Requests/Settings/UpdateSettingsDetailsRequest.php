<?php

namespace App\Http\Requests\Settings;

use App\Rules\CheckPassword;
use App\Rules\CheckPasswordCompilance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UpdateSettingsDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
//        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        $currentPassword = $this->input('current_password');
        return [
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'current_password' => ['nullable', new CheckPassword],
            'password' => [
                Rule::requiredIf(function() use ($currentPassword, $user) {
                    return Hash::check($currentPassword, $user->password);
                }),
                'confirmed',
                Password::defaults()
            ]
        ];
    }

    public function messages()
    {
        return [
            'email' => [
                'required' => 'Электронный адрес обязателен.',
                'email' => 'Электронный адрес некорректен.',
                'unique' => 'Такой электронный адрес зарегистирован в сервисе.',
            ],
            'password' => [
                'required_if'   => 'Это поле обязательно для изменения пароля.',
            ]
        ];
    }
}
