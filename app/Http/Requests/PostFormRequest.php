<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
          'titleform'				=> 'required|max:255',
          'category_idform'	=> 'required|integer',
					'bodyform'				=> 'required',
					'featured_image'	=> 'sometimes|image'
        ];
    }
}
