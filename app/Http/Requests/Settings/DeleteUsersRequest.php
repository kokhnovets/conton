<?php

namespace App\Http\Requests\Settings;

use App\Rules\checkPassword;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected $stopOnFirstFailure = true;
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
        return [
            'delete_password' => [
                'required',
                new CheckPassword
            ]
        ];
    }
}
