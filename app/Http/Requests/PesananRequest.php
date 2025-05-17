<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesananRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'nomor_telp' => 'required|string|max:20',
            'id_kriteria' => 'required|exists:kriterias,id',
            'id_paket' => 'required|exists:pakets,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
            'jumlah_peserta' => 'required|integer|min:1',
            'negara' => 'required|string|max:100',
            'bahasa' => 'required|string|max:100',
            'riwayat_medis' => 'required|string',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'special_request' => 'nullable|string',
            'status' => 'nullable|boolean',
            'id_guide' => 'nullable|exists:guides,id',
        ];
    }

    public function messages()
    {
        return [
            'tanggal_keberangkatan.after_or_equal' => 'The departure date must be the same as or after the booking date.',
        ];
    }
}
