<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
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
            'keyword'=>'required|string'
        ];
    }

    public function messages():array
    {
        return [
            'required'=>':attribute harus diisi',
            'string'=>':attribute harus berupa string',
        ];
    }

    protected function passedValidation():void
    {
        $data = explode('#',$this->input('keyword'));

        $this->merge([
            'nama_produk'=>$data[0],
            'nama_status'=>$data[1] ?? 'bisa dijual',
        ]);
    }
}
