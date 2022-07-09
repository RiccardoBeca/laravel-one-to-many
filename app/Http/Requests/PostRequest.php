<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
        ];
    }

    public function messages(){

        return[
            'title.required' => 'Questo campo e` obbligatorio',
            'title.min' => 'Questo campo deve avere minimo 3 caratteri',
            'title.max' => 'Questo campo deve avere massimo 255 caratteri',
            'content.require' => 'Questo campo e` obbligatorio',
            'content.min' => 'Questo campo deve avere minimo 10 caratteri',
        ];
    }
}
