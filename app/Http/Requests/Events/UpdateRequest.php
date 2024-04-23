<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'judul_events' => 'required|string',
            'nama_events' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar_events' => 'required|image|max:2024|mimes:jpg,jpeg,png',
            'tanggal_events' => 'required|date',
            'deskripsi' => 'required|string',
            'lokasi_events' => 'required|string',
            'harga_events' => 'nullable|numeric',
            'author_events' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
        ];
    }
}
