<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KaryawanUpdateRequest extends FormRequest
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

        $karyawan = $this->route('karyawan');

        return [
            'user_id' => ['required','exists:users,id',],

            'posisi_id' => ['required','exists:posisis,id',],

            'divisi_id' => ['required','exists:divisis,id',],

            'kode_karyawan' => ['required','string','max:50',Rule::unique('karyawans', 'kode_karyawan')->ignore($karyawan),],

            'nik' => ['required','string','max:20',Rule::unique('karyawans', 'nik')->ignore($karyawan),],

            'nama_karyawan' => ['required','string','max:255',],

            'jenis_kelamin' => ['required','in:Laki-laki,Perempuan',],

            'tanggal_lahir' => ['required','date',],

            'no_telepon' => ['nullable','string','max:20',],

            'email' => ['required','email',Rule::unique('karyawans', 'email')->ignore($karyawan),],

            'alamat' => ['nullable','string','max:500',],

            'tanggal_masuk' => ['required','date',],

            'gaji_pokok' => ['required','numeric','min:0',],

            'foto' => ['nullable','image','mimes:jpg,jpeg,png','max:2048',],

            'status' => ['required', 'in:Aktif,Tidak Aktif',],
        ];
    }

     public function messages(): array
    {
        return (new KaryawanStoreRequest())->messages();
    }
}
