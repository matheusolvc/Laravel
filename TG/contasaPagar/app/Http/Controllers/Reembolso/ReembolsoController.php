<?php

namespace App\Http\Controllers\Reembolso;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ReembolsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->tipo_usuario == 'G' || Auth::user()->tipo_usuario == 'G') {
            $reembolsos = Conta::where('tipo_conta', '=', 'R')
                ->orderBy('dt_vencimento', 'asc')
                ->orderBy('status', 'asc')
                ->paginate(7);
        } else {
            $reembolsos = Conta::where('tipo_conta', '=', 'R')
                ->where('id_colaborador', '=', Auth::user()->id)
                ->orderBy('dt_vencimento', 'asc')
                ->paginate(7);
        }

        return view('reembolso.index', compact('reembolsos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reembolso.create');
    }

    public function show($id)
    {
        $reembolso = Conta::FindOrFail($id);
        $reembolso->dt_recibo = date('d/m/Y', strtotime($reembolso->dt_recibo));
        return view('reembolso.show', compact('reembolso'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $reembolso = new Conta();
        $reembolso->tipo_conta = 'R';
        $reembolso->status = 'A';
        $reembolso->num_doc = '0';
        $reembolso->dt_emissao = Carbon::now();
        $reembolso->multa = 0;
        $reembolso->juros = 0;
        $reembolso->dt_recibo = date('Y-m-d', strtotime($request->dt_recibo));
        $reembolso->valor_documento = $request->valor_documento;
        $reembolso->descricao = $request->descricao;
        $reembolso->dt_criacao = Carbon::now();
        $reembolso->id_usuario = Auth::user()->id;
        $reembolso->id_colaborador = Auth::user()->id;

        if ($request->hasFile('arquivo')) {
            $image = $request->file('arquivo');
            $name = time().'_' . $reembolso->id_usuario . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/files/reembolsos');
            $image->move($destinationPath, $name);

            $reembolso->arquivo = '/files/reembolsos' . '/' . $name;
        }

        $reembolso->save();

        return redirect('reembolso/create')
            ->with('message', 'Reembolso criado com sucesso.');
    }

    public function edit($id)
    {
        $reembolso = Conta::FindOrFail($id);
        $reembolso->dt_recibo = date('d/m/Y', strtotime($reembolso->dt_recibo));
        return view('reembolso.edit', compact('reembolso'));
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
        $reembolso = Conta::FindOrFail($id);
        $reembolso->dt_recibo = $request->dt_recibo;
        $reembolso->valor_documento = $request->valor_documento;
        $reembolso->descricao = $request->descricao;
        $reembolso->dt_alteracao = Carbon::now();
        $reembolso->id_usuario = Auth::user()->id;
        $reembolso->id_colaborador = Auth::user()->id;
        $reembolso->update();

        return redirect('/reembolso/edit/' . $id)
            ->with('message', 'Reembolso alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reembolso = Conta::FindOrFail($id);
        $reembolso->delete();

        return redirect('reembolso')
            ->with('message', 'Reembolso excluido com sucesso.');
    }

    public function recusar($id)
    {
        $reembolso = Conta::FindOrFail($id);
        $reembolso->status = 'R';
        $reembolso->dt_alteracao = Carbon::now();
        $reembolso->dt_pagamento = null;
        $reembolso->id_usuario = Auth::user()->id;
        $reembolso->update();

        return redirect('reembolso')
            ->with('message', 'Reembolso recusado com sucesso.');
    }
}
