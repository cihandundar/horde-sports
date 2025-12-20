<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameRequest extends FormRequest
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
            'home_team' => ['required', 'string', 'max:255'],
            'away_team' => ['required', 'string', 'max:255'],
            'match_date' => ['required', 'date'],
            'match_time' => ['nullable', 'date_format:H:i'],
            'home_score' => ['nullable', 'integer', 'min:0'],
            'away_score' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'in:upcoming,live,finished'],
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
            'home_team.required' => 'Ev sahibi takım adı gereklidir.',
            'home_team.string' => 'Ev sahibi takım adı metin olmalıdır.',
            'home_team.max' => 'Ev sahibi takım adı en fazla 255 karakter olabilir.',
            'away_team.required' => 'Deplasman takımı adı gereklidir.',
            'away_team.string' => 'Deplasman takımı adı metin olmalıdır.',
            'away_team.max' => 'Deplasman takımı adı en fazla 255 karakter olabilir.',
            'match_date.required' => 'Maç tarihi gereklidir.',
            'match_date.date' => 'Geçerli bir tarih girin.',
            'match_time.date_format' => 'Geçerli bir saat formatı girin (örn: 20:00).',
            'home_score.integer' => 'Ev sahibi takım skoru sayı olmalıdır.',
            'home_score.min' => 'Ev sahibi takım skoru en az 0 olabilir.',
            'away_score.integer' => 'Deplasman takımı skoru sayı olmalıdır.',
            'away_score.min' => 'Deplasman takımı skoru en az 0 olabilir.',
            'status.required' => 'Maç durumu gereklidir.',
            'status.in' => 'Maç durumu geçerli değil.',
        ];
    }
}
