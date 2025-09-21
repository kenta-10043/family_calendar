<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_image' => ['nullable', 'image','mimes:png,jpeg'],
        ];
        $messages = [
            'name.required' => '名前を入力してください',
            'name.string' => '名前は文字で入力してください',
            'name.max' => '名前は255字以下で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスは文字で入力してください',
            'email.email' => 'メール形式で入力してください',
            'email.max' => 'メールアドレスは255字以下で入力してください',
            'email.unique' => 'こちらのメールアドレスはすでに登録されています',
            'password.required' => 'パスワードを入力してください',
            'password.string' => 'パスワードは文字列で入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => 'パスワードと一致しません',
            'user_image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'user_image.image' => '画像ファイルをアップロードしてください',
        ];

        Validator::make($input, $rules, $messages)->validate();

        $imagePath='user_images/default.png';

        if(!empty($input['user_image']) && $input['user_image'] instanceof \Illuminate\Http\UploadedFile){
          $imagePath=$input['user_image']->store('user_images','public');
        }
        // instanceof \Illuminate\Http\UploadedFileは画像ファイルのみ認める言う意味



        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'user_image' =>$imagePath,
        ]);
    }
}
