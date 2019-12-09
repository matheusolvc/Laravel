<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class OutrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outrasContas  = Conta::where('tipo_conta', '=', 'O')
            ->orderBy('dt_vencimento', 'asc')
            ->orderBy('status', 'asc')
            ->paginate(7);

        return view('contas.outras.index', compact('outrasContas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::pluck('razao_social', 'id');
        return view('contas.outras.create', compact('fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $outrasContas = new Conta();
        $outrasContas->tipo_conta = 'O';
        $outrasContas->status = 'A';
        $outrasContas->num_doc = $request->num_doc;
        $outrasContas->id_fornecedor = $request->id_fornecedor;
        $outrasContas->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $outrasContas->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
        $outrasContas->valor_documento = $request->valor_documento;
        $outrasContas->multa = $request->multa;
        $outrasContas->juros = $request->juros;
        $outrasContas->dt_criacao = Carbon::now();
        $outrasContas->id_usuario = Auth::user()->id;
        $outrasContas->save();

        return redirect('contas/outras/create')
            ->with('message', 'Conta criada com sucesso.');
    }

    public function edit($id)
    {
        $outraConta = Conta::FindOrFail($id);
        $outraConta->dt_emissao = date('d/m/Y', strtotime($outraConta->dt_emissao));
        $outraConta->dt_vencimento = date('d/m/Y', strtotime($outraConta->dt_vencimento));
        $fornecedores = Fornecedor::pluck('razao_social', 'id');

        return view('contas.outras.edit', compact('outraConta', 'fornecedores'));
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
        $outrasContas = Conta::FindOrFail($id);
        $outrasContas->id_fornecedor = $request->id_fornecedor;
        $outrasContas->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $outrasContas->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
        $outrasContas->valor_documento = $request->valor_documento;
        $outrasContas->multa = $request->multa;
        $outrasContas->juros = $request->juros;
        $outrasContas->dt_alteracao = Carbon::now();
        $outrasContas->id_usuario = Auth::user()->id;
        $outrasContas->update();

        return redirect('/contas/outras/edit/' . $id)
            ->with('message', 'Conta alterada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outrasContas = Conta::FindOrFail($id);
        $outrasContas->delete();

        return redirect('contas/outras')
            ->with('message', 'outrasContas excluido com sucesso.');
    }
}
