<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'photo' => 'required|mimes:png,svg,jpg|max:5128',
            'price' => 'required',
            'about' => 'max:255',
            'category_id' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return array (
            'name.required' => 'Nama produk harus diisi',
            'name.string' => 'Nama produk harus karakter',
            'name.min' => 'Nama produk min. 3 karakter',
            'name.max' => 'Nama produk maks. 255 karakter',
            'photo.required' => 'Foto produk harus diisi (png, svg, jpg)',
            'photo.mimes' => 'File harus ber tipe png, svg, atau jpg',
            'photo.max' => 'Maksimal ukuran foto hanya 5mb',
            'category_id.required' => 'Kategori harus diisi',
        );
    }
}
