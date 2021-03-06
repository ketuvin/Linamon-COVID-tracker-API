<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; 
use App\Exceptions\MyValidationException;
use App\LaCovidCase;
use App\Barangay;

class CovidCaseUpdateRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new MyValidationException($validator);
    }

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
            'first_name' => 'min:3',
            'last_name' => 'min:3',
            'alias' => 'min:3',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {  
        $covidcase = LaCovidCase::find($this->route('covid_case_id'));
        // covid case validator
        $validator->after(function ($validator) use ($covidcase) {
            if (!$covidcase) {
                $validator->errors()->add('covid_case_id', 'Person not found.');
            }
        });

        // Barangay validator
        if ($this->request->has('barangay_id')) {
            $barangay = Barangay::find($this->request->get('barangay_id'));

            $validator->after(function ($validator) use ($barangay) {
                if (!$barangay) {
                    $validator->errors()->add('barangay_id', 'Barangay not found.');
                }
            });
        }
    }
}
