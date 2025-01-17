<?php

namespace App\Http\Requests;

use App\Models\Kategori;
use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'nama_kategori'=>['required','string','max:255',function ($attribute, $value, $fail) {
                $count = Kategori::query()->where('nama_kategori',$value)->count();
                if ($count > 0){
                    $fail(':attribute sudah ada');
                }
            }],
        ];
    }

    public function messages():array
    {
        return [
            'required'=>':attribute harus diisi',
            'string'=>':attribute harus berupa string',
            'max'=>':attribute maksimal :max karakter',
        ];
    }
}
