<?php

namespace App\Http\Controllers\Reembolso;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReembolsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $reembolsos  = Conta::where('tipo_conta', '=', 'R')->paginate(7);
        // return view('contas.boletos.index', compact('reembolsos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reembolso.solicitacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('anexo')) {
            $image = $request->file('anexo');
            $name = 'grupo' . $grupos->id_grupo . '.' . $image->getClientOriginalExtension();
            $destinationPath = base_path('public/images/grupos');
            $image->move($destinationPath, $name);

            $grupos->img = asset('images/grupos') . '/' . $name;
        }


        $boleto = new Conta();
        $boleto->tipo_conta = 'B';
        $boleto->status = 'A';
        $boleto->num_doc = $request->num_doc;
        $boleto->codigo_barras = $request->codigo_barras;
        $boleto->id_fornecedor = $request->id_fornecedor;
        $boleto->dt_emissao = $request->dt_emissao;
        $boleto->dt_vencimento = $request->dt_vencimento;
        $boleto->valor_documento = $request->valor_documento;
        $boleto->multa = $request->multa;
        $boleto->juros = $request->juros;
        $boleto->dt_criacao = Carbon::now();
        $boleto->id_usuario = Auth::user()->id;
        $boleto->save();

        return redirect('contas/boletos/create')
            ->with('message', 'Boleto criado com sucesso.');
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
        $boleto = Conta::FindOrFail($id);
        $fornecedores = Fornecedor::pluck('razao_social', 'id');


        return view('contas.boletos.edit', compact('boleto', 'fornecedores'));
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
        $boleto = Conta::FindOrFail($id);
        $boleto->codigo_barras = $request->codigo_barras;
        $boleto->id_fornecedor = $request->id_fornecedor;
        $boleto->dt_emissao = $request->dt_emissao;
        $boleto->dt_vencimento = $request->dt_vencimento;
        $boleto->valor_documento = $request->valor_documento;
        $boleto->multa = $request->multa;
        $boleto->juros = $request->juros;
        $boleto->dt_alteracao = Carbon::now();
        $boleto->id_usuario = Auth::user()->id;
        $boleto->update();

        return redirect('/contas/boletos/edit/' . $id)
            ->with('message', 'Boleto alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boleto = Conta::FindOrFail($id);
        $boleto->delete();

        return redirect('contas/boletos')
            ->with('message', 'Boleto excluido com sucesso.');
    }

    public function solicitacoes()
    {
        if (Auth::user()->tipo_usuario == 'G' || Auth::user()->tipo_usuario == 'G') {
            $reembolsos = Conta::where('tipo_conta', '=', 'R')->paginate(7);
        } else {
            $reembolsos = Conta::where('tipo_conta', '=', 'R')
                ->where('id_usuario', '=', Auth::user()->id)
                ->paginate(7);
        }

        return view('reembolso.solicitacoes.index', compact('reembolsos'));
    }
}
