<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ImpostosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impostos  = Conta::where('tipo_conta', '=', 'I')->paginate(7);
        return view('contas.impostos.index', compact('impostos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contas.impostos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imposto = new Conta();
        $imposto->tipo_conta = 'I';
        $imposto->status = 'A';
        $imposto->num_doc = $request->num_doc;
        $imposto->cod_imposto = $request->cod_imposto;
        $imposto->codigo_barras = $request->codigo_barras;
        $imposto->periodo_apuracao = $request->periodo_apuracao;
        $imposto->cnpj_matriz = $request->cnpj_matriz;
        $imposto->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $imposto->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
        $imposto->valor_documento = $request->valor_documento;
        $imposto->multa = $request->multa;
        $imposto->juros = $request->juros;
        $imposto->dt_criacao = Carbon::now();
        $imposto->id_usuario = Auth::user()->id;
        $imposto->save();

        return redirect('contas/impostos/create')
            ->with('message', 'imposto criado com sucesso.');
    }

    public function edit($id)
    {
        $imposto = Conta::FindOrFail($id);
        $imposto->dt_emissao = date('d/m/Y', strtotime($imposto->dt_emissao));
        $imposto->dt_vencimento = date('d/m/Y', strtotime($imposto->dt_vencimento));

        return view('contas.impostos.edit', compact('imposto'));
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
        $imposto = Conta::FindOrFail($id);
        $imposto->codigo_barras = $request->codigo_barras;
        $imposto->periodo_apuracao = $request->periodo_apuracao;
        $imposto->cnpj_matriz = $request->cnpj_matriz;
        $imposto->id_fornecedor = $request->id_fornecedor;
        $imposto->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $imposto->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
        $imposto->valor_documento = $request->valor_documento;
        $imposto->multa = $request->multa;
        $imposto->juros = $request->juros;
        $imposto->dt_alteracao = Carbon::now();
        $imposto->id_usuario = Auth::user()->id;
        $imposto->update();

        return redirect('/contas/impostos/edit/' . $id)
            ->with('message', 'imposto alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imposto = Conta::FindOrFail($id);
        $imposto->delete();

        return redirect('contas/impostos')
            ->with('message', 'imposto excluido com sucesso.');
    }
}
