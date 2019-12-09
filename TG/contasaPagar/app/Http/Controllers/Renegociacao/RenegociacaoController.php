<?php

namespace App\Http\Controllers\Renegociacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renegociacao;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Conta;
use App\Models\Caixa;

class RenegociacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $renegociacoes  = Renegociacao::paginate(7);

        return view('contas.renegociacao.index', compact('renegociacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $renegociacao = new Renegociacao();
        $renegociacao->id_conta = $id;

        return view('contas.renegociacao.create', compact('renegociacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conta = Conta::FindOrFail($request->id_conta);
        $conta->status = 'E';
        $conta->dt_alteracao = Carbon::now();
        $conta->id_usuario = Auth::user()->id;
        $conta->update();


        $renegociacao = new Renegociacao();
        $renegociacao->id_conta = $conta->id;
        $renegociacao->id_usuario = Auth::user()->id;
        $renegociacao->status = 'A';
        $renegociacao->dt_solicitacao = Carbon::now();
        $renegociacao->tipo_renegociacao = $request->tipo_renegociacao;
        $renegociacao->qtde_parcelas = $request->qtde_parcelas;
        $renegociacao->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
        $renegociacao->valor_novo = $request->valor_novo;
        $renegociacao->observacao = $request->observacao;
        $renegociacao->save();
        $renegociacao->refresh();

        for($i=1; $i <= $renegociacao->qtde_parcelas; $i++){
            $conta_nova = new Conta();
            $conta_nova->status            = 'A';
            $conta_nova->tipo_conta        = $conta->tipo_conta;
            $conta_nova->dt_criacao        = Carbon::now();
            $conta_nova->dt_alteracao      = null;
            $conta_nova->dt_emissao        = Carbon::now();
            if($renegociacao->tipo_renegociacao == 'P'){
                $conta_nova->dt_vencimento = $i == 1 ? date('Y-m-d', strtotime($renegociacao->dt_vencimento)) : date('Y-m-d', strtotime('+'.$i.' months', $renegociacao->dt_vencimento));
            }
            $conta_nova->dt_pagamento      = null;
            $conta_nova->id_renegociacao   = $renegociacao->id;
            $conta_nova->valor_documento   = ($renegociacao->valor_novo + $conta->multa + $conta->juros) / $renegociacao->qtde_parcelas;
            $conta_nova->multa             = $conta->multa;
            $conta_nova->juros             = $conta->juros;
            $conta_nova->id_usuario        = Auth::user()->id;
            $conta_nova->num_doc           = $conta->num_doc;
            $conta_nova->serie             = null;
            $conta_nova->save();
        }

        return redirect()->route('contas.renegociacao.index')
            ->with('message', 'Renegociação realizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $renegociacao = Renegociacao::FindOrFail($id);

        // foreach($renegociacao->contas as $conta){
        //     $conta->delete();
        // }

        $renegociacao->conta->status = 'A';
        $renegociacao->conta->dt_alteracao = Carbon::now();
        $renegociacao->conta->id_usuario = Auth::user()->id;
        $renegociacao->conta->id_renegociacao = null;
        $renegociacao->conta->update();

        $renegociacao->delete();

        return redirect()->route('contas.renegociacao.index')
            ->with('message', 'Renegociação excluida com sucesso.');
    }

    public function pagar($id)
    {
        $renegociacao = Renegociacao::FindOrFail($id);
        $caixa = Caixa::first();

        if($caixa->saldo < $renegociacao->valor_novo){
            return redirect()->route('contas.renegociacao.index')
                ->with('error', 'Saldo insuficiente.');
        }

        foreach($renegociacao->contas as $conta){
            $conta->status = 'P';
            $conta->dt_alteracao = Carbon::now();
            $conta->dt_pagamento = Carbon::now();
            $conta->id_usuario = Auth::user()->id;
            $conta->update();

            $caixa->saldo -= $conta->valor_documento;
            $caixa->update();
        }

        $renegociacao->id_usuario = Auth::user()->id;
        $renegociacao->status = 'P';
        $renegociacao->update();

        return redirect()->route('contas.renegociacao.index')
            ->with('message', 'Renegociação paga com sucesso.');
    }
}
