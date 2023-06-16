<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'main_category' => 'required|string|max:100|unique:main_categories',
        ];
    }

    public function messages()
    {
        return [
            'main_category.required' => 'メインカテゴリー名は必須項目です。',
            'main_category.string' => 'メインカテゴリー名は文字列で入力してください。',
            'main_category.max' => 'メインカテゴリー名は100文字以内で入力してください。',
            'main_category.unique' => 'このメインカテゴリー名は既に登録されています。'
            ];
        }
}
