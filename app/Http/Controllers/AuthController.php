<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }
    
    public function registration(Request $request)
    {
        $jsonPath = storage_path('app/users.json');
        $users = [];
        
        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $users = json_decode($jsonContent, true);
            
            foreach ($users as $user) {
                if ($user['email'] === $request->input('email')) {
                    return redirect()->back()
                        ->withErrors(['email' => 'Пользователь с таким email уже зарегистрирован'])
                        ->withInput();
                }
            }
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Поле имя обязательно для заполнения',
            'name.min' => 'Имя должно содержать минимум 2 символа',
            'email.required' => 'Поле email обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'password.required' => 'Поле пароль обязательно для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $nextId = 1;
        if (!empty($users)) {
            $lastUser = end($users);
            $nextId = $lastUser['id'] + 1;
        }
        
        $newUser = [
            'id' => $nextId,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString()
        ];
        
        $users[] = $newUser;
        
        File::put($jsonPath, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return redirect()->route('signin.create')
            ->with('success', 'Регистрация прошла успешно!');
    }
}