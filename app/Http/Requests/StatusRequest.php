<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
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
            'nama_status'=>['required','string','max:255',function ($attribute, $value, $fail) {
                //Check status
                $status = Status::query()->firstWhere('nama_status',$value);
                if ($status){
                    $fail(':attribute sudah ada');
                }
            }]
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
