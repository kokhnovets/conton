<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateSettingsPhoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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

        return [
            'phone' =>'nullable|phone:RU|' . Rule::unique('users')->ignore($user->id),
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'phone' => preg_replace("/[^0-9]/", '', $this->phone),
        ]);
    }
    public function messages()
    {
        return [
            'phone' => 'Номер телефона имеет неверный формат.'
        ];
    }
}
