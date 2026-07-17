<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DivisiStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_divisi' => ['required', 'string', 'max:255', 'unique:divisis,nama_divisi'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_divisi.required' => 'Nama divisi harus diisi.',
            'nama_divisi.string' => 'Nama divisi harus berupa string.',
            'nama_divisi.max' => 'Nama divisi tidak boleh lebih dari 255 karakter.',
            'deskripsi.string' => 'Deskripsi harus berupa string.',
        ];
    }
}
