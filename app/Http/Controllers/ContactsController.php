<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
    
        $contacts = [
            [
                'type' => 'phone',
                'title' => 'Телефон',
                'value' => '+7 (999) 123-45-67',
                'description' => 'Пн-Пт: 9:00 - 18:00',
                'is_link' => true,
                'link_prefix' => 'tel:'
            ],
            [
                'type' => 'email',
                'title' => 'Email',
                'value' => 'ldbcndcx1@mozmail.com',
                'description' => 'По общим вопросам',
                'is_link' => true,
                'link_prefix' => 'mailto:'
            ],
            [
                'type' => 'telegram',
                'title' => 'Telegram',
                'value' => '@rindesuu13',
                'description' => 'Быстрая связь',
                'is_link' => true,
                'link_prefix' => 'https://t.me/'
            ]
        ];
        
        $social = [
            ['name' => 'Telegram', 'url' => 'https://t.me/rindesuu13'],
            ['name' => 'VK', 'url' => 'https://vk.com/'],
            ['name' => 'YouTube', 'url' => 'https://youtube.com/']
        ];
        
        return view('contacts', compact('contacts', 'social'));
    }
}
