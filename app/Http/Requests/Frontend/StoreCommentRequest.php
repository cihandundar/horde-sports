<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
        $user = Auth::user();
        
        $rules = [
            'news_id' => ['required', 'exists:news,id'],
            'content' => ['required', 'string', 'min:3', 'max:1000'],
        ];

        // Eğer kullanıcı giriş yapmamışsa, name ve email zorunlu
        if (!$user) {
            $rules['name'] = ['required', 'string', 'max:255'];
            $rules['email'] = ['required', 'email', 'max:255'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'news_id.required' => 'Haber bilgisi gereklidir.',
            'news_id.exists' => 'Seçilen haber bulunamadı.',
            'content.required' => 'Yorum içeriği gereklidir.',
            'content.string' => 'Yorum içeriği metin olmalıdır.',
            'content.min' => 'Yorum en az 3 karakter olmalıdır.',
            'content.max' => 'Yorum en fazla 1000 karakter olabilir.',
            'name.required' => 'Ad soyad gereklidir.',
            'name.string' => 'Ad soyad metin olmalıdır.',
            'name.max' => 'Ad soyad en fazla 255 karakter olabilir.',
            'email.required' => 'E-posta adresi gereklidir.',
            'email.email' => 'Geçerli bir e-posta adresi girin.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olabilir.',
        ];
    }
}
