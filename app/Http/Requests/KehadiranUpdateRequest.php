<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KehadiranUpdateRequest extends FormRequest
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
            'karyawan_id' => [
                'required',
                'exists:karyawans,id',
            ],

            'tanggal_kehadiran' => [
                'required',
                'date',
            ],

            'jam_masuk' => [
                'nullable',
                'date_format:H:i',
            ],

            'jam_keluar' => [
                'nullable',
                'date_format:H:i',
                'after:jam_masuk',
            ],

            'status' => [
                'required',
                'in:Hadir,Izin,Sakit,Cuti,Alpha',
            ],

            'menit_keterlambatan' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'karyawan_id.required' => 'Karyawan wajib dipilih.',
            'karyawan_id.exists' => 'Karyawan tidak valid.',

            'tanggal_kehadiran.required' => 'Tanggal kehadiran wajib diisi.',
            'tanggal_kehadiran.date' => 'Format tanggal tidak valid.',

            'status.required' => 'Status wajib dipilih.',

            'jam_keluar.after' => 'Jam keluar harus setelah jam masuk.',
        ];
    }
}
