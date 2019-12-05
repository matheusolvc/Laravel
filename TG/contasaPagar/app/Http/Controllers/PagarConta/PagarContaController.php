<?php

namespace App\Http\Controllers\PagarConta;

use App\Http\Controllers\Controller;
use App\Models\Caixa;
use App\Models\Conta;
use Illuminate\Http\Request;
use App\Models\Lote;
use App\Models\RetornoLote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class PagarContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotes = Lote::where('status', '=', 'A')->paginate(3);
        $retorno_lotes = RetornoLote::paginate(3);

        return view('pagar-contas.index', compact('lotes', 'retorno_lotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contas = Conta::where('status', '=', 'A')
            ->where('id_lote', '=', null)
            ->paginate(5);

        return view('pagar-contas.create', compact('contas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->id_contas = explode(',', $request->id_contas);

        $contas = Conta::Find($request->id_contas);

        if(count($contas) == 0) {
            return redirect()->route('pagar-conta.create')
                ->with('error', 'Não há contas selecionadas.');
        }


        $lote = new Lote();
        $lote->id_usuario = Auth::user()->id;
        $lote->dt_geracao = Carbon::now();
        $lote->valor_lote = 0;
        $lote->status = 'A';
        $lote->save();
        $lote->refresh();

        $valor_lote = 0;

        foreach($contas as $conta){
            $conta->id_lote = $lote->id;
            $conta->dt_alteracao = Carbon::now();
            $conta->id_usuario = Auth::user()->id;
            $conta->update();

            $valor_lote += $conta->valor_documento;
        }

        $lote->valor_lote = $valor_lote;
        $lote->update();

        return redirect()->route('pagar-conta.create')
            ->with('message', 'Remessa gerada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lote = Lote::FindOrFail($id);
        $lote_contas = Conta::where('id_lote', '=', $lote->id)->paginate(5);
        $contas = Conta::where('status', '=', 'A')
            ->where('id_lote', '=', null)
            ->paginate(5);

        return view('pagar-contas.edit', compact('lote', 'contas', 'lote_contas'));
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
        $lote = Lote::FindOrFail($id);

        $request->id_contas = explode(',', $request->id_contas);

        $contas = Conta::Find($request->id_contas);

        if(count($contas) == 0 && count($lote->contas) == 0) {
            return redirect()->route('pagar-conta.edit', ['id'=>$lote->id])
                ->with('error', 'Não há contas selecionadas.');
        }

        $lote->id_usuario = Auth::user()->id;
        $lote->dt_alteracao = Carbon::now();
        $lote->status = 'A';
        $lote->update();
        $lote->refresh();

        $valor_lote = 0;

        foreach($contas as $conta){
            $conta->id_lote = $lote->id;
            $conta->dt_alteracao = Carbon::now();
            $conta->id_usuario = Auth::user()->id;
            $conta->update();

            $valor_lote += $conta->valor_documento;
        }

        $lote->valor_lote = $valor_lote;
        $lote->update();

        return redirect()->route('pagar-conta.edit', ['id' => $lote->id])
            ->with('message', 'Remessa alterada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lote = Lote::FindOrFail($id);

        foreach($lote->contas as $conta){
            $conta->dt_alteracao = Carbon::now();
            $conta->id_usuario = Auth::user()->id;
            $conta->id_lote = null;
            $conta->update();
        }

        $lote->delete();

        return redirect()->route('pagar-conta.index')
            ->with('message', 'Remessa excluida com sucesso.');
    }

    public function destroyConta($id, $id_conta)
    {
        $conta = Conta::FindOrFail($id_conta);
        $conta->dt_alteracao = Carbon::now();
        $conta->id_usuario = Auth::user()->id;
        $conta->id_lote = null;
        $conta->update();

        $lote = Lote::FindOrFail($id);
        $lote->valor_lote -= $conta->valor_documento;
        $lote->update();

        return redirect()->route('pagar-conta.edit', ['id' => $id])
            ->with('message', 'Remessa alterada com sucesso.');
    }

    public function processar($id)
    {
        $lote = Lote::FindOrFail($id);

        $caixa = Caixa::First();

        $retorno_status = '';
        $retorno_mensagem = '';

        if($caixa->saldo < $lote->valor_lote){
            $retorno_status = 'F';
            $retorno_mensagem = 'Falha no processamento da Remessa saldo insuficiente data: ' . date('d/m/Y h:i:s');
            $lote->status = 'E';
        } else {
            $retorno_status = 'S';
            $retorno_mensagem = 'Lote precessado com sucesso data: ' . date('d/m/Y h:i:s');

            foreach($lote->contas as $conta){
                $conta->status = 'P';
                $conta->dt_alteracao = Carbon::now();
                $conta->dt_pagamento = Carbon::now();
                $conta->id_usuario = Auth::user()->id;
                $conta->update();

                $caixa->saldo -= $conta->valor_documento;
                $caixa->update();
            }

            $lote->status = 'F';
        }

        $retorno_lote = RetornoLote::updateOrCreate(
            ['id_lote' => $lote->id],
            ['status' => $retorno_status, 'mensagem' => $retorno_mensagem]
        );

        $lote->id_usuario = Auth::user()->id;
        $lote->dt_alteracao = Carbon::now();
        $lote->dt_transmissao = Carbon::now();
        $lote->update();

        if($retorno_lote->status == 'P'){
            return redirect()->route('pagar-conta.index')
                    ->with('message', 'Remessa processada com sucesso.');
        } else {
            return redirect()->route('pagar-conta.index')
                    ->with('error', 'Falha no processamento da remessa verifique o retorno.');
        }
    }
}
