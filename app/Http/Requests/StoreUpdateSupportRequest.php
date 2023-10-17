<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSupportRequest extends FormRequest
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
        $id = $this->id ?? $this->support;

        $rules = [
            'subject' => "required|min:3|max:255|unique:supports,subject,{$id},id",
            'body' => 'required|min:3|max:10000',
        ];

        if ($this->isMethod('PATCH')) {
            $rules['subject'] = "min:3|max:255|unique:supports,subject,{$id},id";
            $rules['body'] = 'min:3|max:10000';
        }

        return $rules;
    }
}
