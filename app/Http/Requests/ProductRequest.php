<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
                    case 'add':
                        $rules = [
                            'name' => "required|unique:sinh_vien",
                            'price' => 'required',
                            'image' => 'required',
                            'description_short' => 'required',
                            'description' => 'required'
                        ];
                        break;
                    case 'edit':
                        $rules = [
                            'name' => "required|unique:sinh_vien",
                            'price' => 'required',
                            'description_short' => 'required',
                            'description' => 'required'
                        ];
                        break;
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
            'name.required' => "Tên không được để trống",
            'image.required' => "Ảnh không được để trống",
            'price.required' => "Giá không được để trống",
            'description_short.required' => "Mô tả ngắn không được để trống",
            'description.required' => "Mô tả ngắn không được để trống"
        ];
    }
}
