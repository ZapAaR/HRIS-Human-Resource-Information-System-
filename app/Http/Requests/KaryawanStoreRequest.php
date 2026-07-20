<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KaryawanStoreRequest extends FormRequest
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
            'user_id' => ['required','exists:users,id',],

            'posisi_id' => ['required','exists:posisis,id',],

            'divisi_id' => ['required','exists:divisis,id',],

            'kode_karyawan' => ['required','string','max:50','unique:karyawans,kode_karyawan',],

            'nik' => ['required','string','max:20','unique:karyawans,nik',],

            'nama_karyawan' => ['required','string','max:255',],

            'jenis_kelamin' => ['required','in:Laki-laki,Perempuan',],

            'tanggal_lahir' => ['required','date',],

            'no_telepon' => ['nullable','string','max:20',],

            'email' => ['required','email','unique:karyawans,email',],

            'alamat' => ['nullable','string','max:500',],

            'tanggal_masuk' => ['required','date',],

            'gaji_pokok' => ['required','numeric','min:0',],

            'foto' => ['nullable','image','mimes:jpg,jpeg,png','max:2048',],

            'status' => ['required', 'in:Aktif,Tidak Aktif',],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required'       => 'User wajib dipilih.',
            'posisi_id.required'     => 'Posisi wajib dipilih.',
            'divisi_id.required'     => 'Divisi wajib dipilih.',
            'kode_karyawan.required' => 'Kode Karyawan wajib diisi.',
            'kode_karyawan.unique'   => 'Kode Karyawan sudah digunakan.',
            'nik.required'           => 'NIK wajib diisi.',
            'nik.unique'             => 'NIK sudah digunakan.',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah digunakan.',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi.',
            'tanggal_masuk.required' => 'Tanggal Masuk wajib diisi.',
            'gaji_pokok.required'    => 'Gaji Pokok wajib diisi.',
            'foto.image'             => 'File harus berupa gambar.',
            'foto.max'               => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
