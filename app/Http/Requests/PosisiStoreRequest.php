<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PosisiStoreRequest extends FormRequest
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
            'divisi_id'   => ['required', 'exists:divisis,id'],
            'nama_posisi' => ['required', 'string', 'max:255'],
            'deskripsi'   => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'divisi_id.required'   => 'Divisi wajib dipilih.',
            'divisi_id.exists'     => 'Divisi tidak valid.',
            'nama_posisi.required' => 'Nama posisi wajib diisi.',
            'nama_posisi.max'      => 'Nama posisi maksimal 255 karakter.',
            'deskripsi.max'        => 'Deskripsi maksimal 1000 karakter.',
        ];
    }
}
