<?php

namespace App\Http\Controllers\Contas;
use App\Models\Conta;
use App\Models\Caixa;
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contas.boletos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        $caixa->saldo -= $conta->valor_documento;
        $caixa->update();

        return redirect()->route($redirect)
            ->with('message', 'Conta paga com sucesso.');
    }
}
