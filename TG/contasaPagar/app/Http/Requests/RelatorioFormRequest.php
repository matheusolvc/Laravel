<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;

class RelatorioFormRequest extends FormRequest
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
        dd($this);
        return [
            'dt_inicial' => 'required|date',
            'dt_final' => 'required|date'
        ];
    }

    public function message()
    {
        return [
            'dt_inicial.required'      => 'O campo data de Inicial é de preenchimento obrigatório.',
            'dt_final.required'   => 'O campo data de Final é de preenchimento obrigatório.'
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
            'dt_inicial' => 'trim|format_date:d/m/Y, Y-m-d',
            'dt_final' => 'trim|format_date:d/m/Y, Y-m-d'
        ];
    }
}
