<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
        $category = $this->route('category');
        $categoryId = $category ? $category->id : null;
        
        return [
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $categoryId],
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
            'name.required' => 'Kategori adı gereklidir.',
            'name.string' => 'Kategori adı metin olmalıdır.',
            'name.max' => 'Kategori adı en fazla 255 karakter olabilir.',
            'name.unique' => 'Bu kategori adı zaten kullanılıyor.',
        ];
    }
}
