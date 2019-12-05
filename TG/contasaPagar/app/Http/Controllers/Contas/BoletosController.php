<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BoletosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boletos  = Conta::where('tipo_conta', '=', 'B')->paginate(7);
        return view('contas.boletos.index', compact('boletos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::pluck('razao_social', 'id');
        return view('contas.boletos.create', compact('fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        dd($id);
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
}
