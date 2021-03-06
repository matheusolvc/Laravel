<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Classes\lib\boletosPHP;
use App\Http\Requests\StoreContaRequest;

class BoletosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boletos  = Conta::where('tipo_conta', '=', 'B')
            ->orderBy('dt_vencimento', 'asc')
            ->orderBy('status', 'asc')
            ->paginate(7);

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
    public function store(StoreContaRequest $request)
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boleto = Conta::FindOrFail($id);
        $boleto->dt_emissao = date('d/m/Y', strtotime($boleto->dt_emissao));
        $boleto->dt_vencimento = date('d/m/Y', strtotime($boleto->dt_vencimento));

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
    public function update(StoreContaRequest $request, $id)
    {
        $boleto = Conta::FindOrFail($id);
        $boleto->codigo_barras = $request->codigo_barras;
        $boleto->id_fornecedor = $request->id_fornecedor;
        $boleto->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $boleto->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));
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

    public function lerBoleto($cod_barras)
    {
        $barras = new boletosPHP();

        $linha_digitavel = substr($cod_barras, 0, 5) . '.';
        $linha_digitavel .= substr($cod_barras, 5, 5). ' ';
        $linha_digitavel .= substr($cod_barras, 10, 5). '.';
        $linha_digitavel .= substr($cod_barras, 15, 6). ' ';
        $linha_digitavel .= substr($cod_barras, 21, 5). '.';
        $linha_digitavel .= substr($cod_barras, 26, 6). ' ';
        $linha_digitavel .= substr($cod_barras, 32, 1). ' ';
        $linha_digitavel .= substr($cod_barras, 33, 14);

        $barras->setIpte($linha_digitavel);

        $json = [
            "valor_doc" => $barras -> getValorDocumento(),
            "dt_vencimento" => $barras -> getDtVencimento(),
        ];

        return response()
            ->json($json);

    }
}
