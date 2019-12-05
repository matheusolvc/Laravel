<?php

namespace App\Http\Controllers\Contas;
use App\Models\Conta;
use App\Models\Caixa;
use App\Models\Renegociacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ContasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $contas;

    public function __construct(Conta $contas)
    {
        $this->contas = $contas;
    }

    public function pagar($id, $redirect)
    {
        $caixa = Caixa::First();
        $conta = Conta::FindOrFail($id);

        if($caixa->saldo < $conta->valor_documento)
            return redirect()->route($redirect)
                ->with('error', 'Caixa com saldo insuficiente.');

        $conta->status = 'P';
        $conta->dt_alteracao = Carbon::now();
        $conta->dt_pagamento = Carbon::now();
        $conta->id_usuario = Auth::user()->id;
        $conta->update();

        if($conta->id_renegociacao != null) {
            $contas_renegociadas = Conta::where('id_renegociacao', '=', $conta->id_renegociacao)
                ->where('status', '=', 1)
                ->get();

            if(count($contas_renegociadas == 0))
            {
                $renegociacao = Renegociacao::FindOrFail($conta->id_renegociacao);
                $renegociacao->status = 'P';
                $renegociacao->update();
            }
        }

        $caixa->saldo -= $conta->valor_documento;
        $caixa->update();

        return redirect()->route($redirect)
            ->with('message', 'Conta paga com sucesso.');
    }
}
