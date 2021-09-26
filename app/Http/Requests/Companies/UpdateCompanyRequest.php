<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
        $custom = (isset($this->company->id))?
            'required|unique:companies,email,'.$this->company->id.',id|max:355':'required|unique:companies|max:355';
       
        return [
            'name' => 'required',
            //skip validation
            'email' => $custom,
            'website' => 'required',
        ];
    }
}
