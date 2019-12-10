<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class StoreContaRequest extends FormRequest
{
    use SanitizesInput;

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
     *  Validation rules to be applied to the input.
     *
     *  @return array
     */
    public function rules()
    {
        return [
            'valor_documento' => 'required|unique:users',
            'dt_emissao' => 'required|string|max:50',
            'dt_vencimento' => 'required|string|max:50',
            'multa' => 'required',
            'juros' => 'required',
            'num_doc' => 'required'
        ];
    }


    public function message()
    {
        return [
            'valor_documento.required' => 'O campo valor do documento é de preenchimento obrigatório.',
            'dt_emissao.required'      => 'O campo data de emissao é de preenchimento obrigatório.',
            'dt_vencimento.required'   => 'O campo data de vencimento é de preenchimento obrigatório.',
            'multa.required'           => 'O campo multa é de preenchimento obrigatório.',
            'juros.required'           => 'O campo juros é de preenchimento obrigatório.',
            'num_doc.required'         => 'O campo númerp do documento é de preenchimento obrigatório.'
        ];
    }


    /**
     *  Filters to be applied to the input.
     *
     *  @return array
     */
    public function filters()
    {
        return [
            'valor_documento' => 'trim',
            'dt_emissao' => 'trim|format_date:d/m/Y, Y-m-d',
            'dt_vencimento' => 'trim|format_date:d/m/Y, Y-m-d',
            'multa' => 'trim|escape',
            'juros' => 'trim|escape',
            'num_doc' => 'trim|escape',
            'codigo_barras' => 'trim|escape|digit',
            'cnpj_matriz' => 'trim|escape|digit'
        ];
    }
}
