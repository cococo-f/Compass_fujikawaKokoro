<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryFormRequest extends FormRequest
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
            'main_category_id' => 'required|exists:sub_categories,id',
            'sub_category' =>  'required|string|max:100|unique:sub_categories',
        ];
    }

    public function messages()
    {
        return [
            'main_category_id.required' => 'メインカテゴリーは選択必須です。',
            'main_category.exists' => 'このメインカテゴリーは登録されていません。',
            'sub_category.required' => 'サブカテゴリー名は必須項目です。',
            'sub_category.string' => 'サブカテゴリー名は文字列で入力してください。',
            'sub_category.max' => 'サブカテゴリー名は100文字以内で入力してください。',
            'sub_category.unique' => 'このサブカテゴリー名は既に登録されています。',
            ];
    }
}
