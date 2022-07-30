<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [];
        //lấy phương thức hiện tại
        $currentAcction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAcction) {
                    case 'login':
                        $rules = [
                            'email' => 'required|email',
                            'password' => 'required'
                        ];
                    default:
                        break;
                }
                break;
            default:
                break;
        endswitch;

        return $rules;
    }
    public function messages()
    {
        return [
            'email.required' => "Vui lòng không để trống !",
            'email.email' => "Email không đúng đinh dạng !",
            'password.required' => "Vui lòng không để trống !"
        ];
    }
    
}
