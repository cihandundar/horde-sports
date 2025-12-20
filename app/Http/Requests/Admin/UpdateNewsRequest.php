<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'author_id' => ['required', 'exists:authors,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Başlık gereklidir.',
            'title.string' => 'Başlık metin olmalıdır.',
            'title.max' => 'Başlık en fazla 255 karakter olabilir.',
            'content.required' => 'İçerik gereklidir.',
            'content.string' => 'İçerik metin olmalıdır.',
            'image.image' => 'Görsel geçerli bir resim dosyası olmalıdır.',
            'image.max' => 'Görsel boyutu en fazla 2MB olabilir.',
            'author_id.required' => 'Yazar seçimi gereklidir.',
            'author_id.exists' => 'Seçilen yazar bulunamadı.',
            'category_id.required' => 'Kategori seçimi gereklidir.',
            'category_id.exists' => 'Seçilen kategori bulunamadı.',
        ];
    }
}
