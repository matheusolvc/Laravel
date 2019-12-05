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
        $renegociacoes  = Conta::where('tipo_conta', '=', 'G')->paginate(7);

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
        $renegociacao = new Renegociacao();
        $renegociacao->id_conta = $request->id_conta;
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

        $conta = Conta::FindOrFail($request->id_conta);
        $conta->status = 'E';
        $conta->dt_alteracao = Carbon::now();
        $conta->id_usuario = Auth::user()->id;
        $conta->update();

        $conta_nova = new Conta();
        $conta_nova->status            = 'A';
        $conta_nova->tipo_conta        = 'G';
        $conta_nova->dt_criacao        = Carbon::now();
        $conta_nova->dt_alteracao      = null;
        $conta_nova->dt_emissao        = Carbon::now();
        $conta_nova->dt_vencimento     = $renegociacao->dt_vencimento;
        $conta_nova->dt_pagamento      = null;
        $conta_nova->id_renegociacao   = $renegociacao->id;
        $conta_nova->valor_documento   = $renegociacao->valor_novo;
        $conta_nova->multa             = $conta->multa;
        $conta_nova->juros             = $conta->juros;
        $conta_nova->id_usuario        = Auth::user()->id;
        $conta_nova->num_doc           = $conta->num_doc;
        $conta_nova->serie             = null;
        $conta_nova->save();

        return redirect()->route('contas.renegociacao.index')
            ->with('message', 'Renegociação realizada com sucesso.');
    }

    public function edit($id)
    {
        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect()->route()
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
        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
    }
}
