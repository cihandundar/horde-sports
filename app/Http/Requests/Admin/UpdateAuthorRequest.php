<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
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
            'name.required' => 'Yazar adı gereklidir.',
            'name.string' => 'Yazar adı metin olmalıdır.',
            'name.max' => 'Yazar adı en fazla 255 karakter olabilir.',
            'bio.string' => 'Biyografi metin olmalıdır.',
            'photo.image' => 'Fotoğraf geçerli bir resim dosyası olmalıdır.',
            'photo.max' => 'Fotoğraf boyutu en fazla 2MB olabilir.',
        ];
    }
}
