<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            // 新規登録画面
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30',
            'mail_address' => 'required|email|max:100|unique:users',
            'sex' => 'required|in:1,2,3',
            'old_year' => 'required|after_or_equal:2000/01/01,today',
            'old_month' => 'required|after_or_equal:2000/01/01,today',
            'old_day' => 'required|after_or_equal:2000/01/01,today',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|min:8|max:30|confirmed',
            // 投稿機能
            'post_title' => 'min:4|max:50',
            'post_body' => 'min:10|max:500',
        ];
    }

    public function messages(){
        return [
            // 新規登録画面
            'over_name.required' => '姓は必須項目です。',
            'over_name.string' => '姓は文字列で入力してください。',
            'over_name.max' => '姓は10文字以内で入力してください。',
            'under_name.required' => '名は必須項目です。',
            'under_name.string' => '名は文字列で入力してください。',
            'under_name.max' => '名は10文字以内で入力してください。',
            'over_name_kana.required' => 'セイは必須項目です。',
            'over_name_kana.string' => 'セイは文字列で入力してください。',
            'over_name_kana.regex' => 'セイはカタカナで入力してください。',
            'over_name_kana.max' => 'セイは30文字以内で入力してください。',
            'under_name_kana.required' => 'メイは必須項目です。',
            'under_name_kana.string' => 'メイは文字列で入力してください。',
            'under_name_kana.regex' => 'メイはカタカナで入力してください。',
            'under_name_kana.max' => 'メイは30文字以内で入力してください。',
            'mail_address.required' => 'メールアドレスは必須項目です。',
            'mail_address.email' => 'メールアドレスの形式で入力してください。',
            'mail_address.max' => 'メールアドレスは100文字以内で入力してください。',
            'mail_address.unique' => 'このメールアドレスは既に登録されています。',
            'sex.required' => '性別は必須項目です。',
            'sex.in' => '性別は男性・女性・その他から選択してください。',
            'old_year.after_or_equal' => '生年月日は2000年1月1日から今日までを選択してください。',
            'old_month.after_or_equal' => '生年月日は2000年1月1日から今日までを選択してください。',
            'old_day.after_or_equal'=> '生年月日は2000年1月1日から今日までを選択してください。',
            'role.required' => '役職は必須項目です。',
            'role.in' => '役職は教師(国語・数学・英語)もしくは生徒から選択してください。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは8文字以上入力してください。',
            'password.max' => 'パスワードは30文字以内で入力してください。',
            'password.confirmed' => '確認用パスワードと一致していません。',
            // 投稿機能
            'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは50文字以内で入力してください。',
            'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.max' => '最大文字数は500文字です。',
        ];
    }
}
