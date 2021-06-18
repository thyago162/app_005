<?php

namespace App\Http\Requests\Veiculo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VeiculoRequest extends FormRequest
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
            'veiculo' => 'required',
            'marca' => 'required',
            'ano' => 'required',
            'descricao' => 'required',
        ];
    }

     /**
     * Retorna mensagens personalizadas de validação
     */
    public function messages()
    {
        return [
            
            'veiculo.required' => 'O campo veiculo é obrigatório',
            'marca.required' => 'O campo marca é obrigatório',
            'ano.required' => 'O campo ano é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            
        ];
    }

    /**
     * Failed validation disable redirect
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
