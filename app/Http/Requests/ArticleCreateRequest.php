<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'short_description' => 'required|string|min:10|max:500',
            'content' => 'required|string|min:20',
            'category' => 'nullable|string|max:100',
            'preview_image' => 'nullable|string|max:255',
            'full_image' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'is_published' => 'boolean',
        ];
    }
    
    public function messages(): array
    {
        return [
            'title.required' => 'Заголовок обязателен для заполнения',
            'title.min' => 'Заголовок должен содержать минимум 3 символа',
            'short_description.required' => 'Краткое описание обязательно',
            'short_description.min' => 'Краткое описание должно содержать минимум 10 символов',
            'content.required' => 'Содержание обязательно',
            'content.min' => 'Содержание должно содержать минимум 20 символов',
        ];
    }
}
