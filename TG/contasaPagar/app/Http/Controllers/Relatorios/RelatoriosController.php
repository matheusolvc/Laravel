<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Fornecedor;
use App\Http\Requests\RelatorioFormRequest;
use App\Models\Conta;

class RelatoriosController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::orderBy('razao_social', 'asc')->pluck('razao_social', 'id');
        return view('relatorios.index', compact('fornecedores'));
    }

    public function gerar(RelatorioFormRequest $request)
    {
        if($request->tipo_conta == null && $request->fornecedor == null){
            $dados = Conta::where('status', '=', 'A')
                ->whereBetween($request->data_de, [$request->dt_inicial, $request->dt_final])
                ->orderBy('dt_vencimento', 'asc')
                ->get();
        } else if ($request->tipo_conta != null && $request->fornecedor != null) {
            $dados = Conta::where('status', '=', 'A')
                ->where('tipo_conta', '=', $request->tipo_conta)
                ->where('id_fornecedor', '=', $request->id_fornecedor)
                ->whereBetween($request->data_de, [$request->dt_inicial, $request->dt_final])
                ->orderBy('dt_vencimento', 'asc')
                ->get();
        } else if($request->tipo_conta != null) {
            $dados = Conta::where('status', '=', 'A')
                ->where('tipo_conta', '=', $request->tipo_conta)
                ->whereBetween($request->data_de, [$request->dt_inicial, $request->dt_final])
                ->orderBy('dt_vencimento', 'asc')
                ->get();
        } else if ($request->id_fornecedor != null) {
            $dados = Conta::where('status', '=', 'A')
                ->where('id_fornecedor', '=', $request->id_fornecedor)
                ->whereBetween($request->data_de, [$request->dt_inicial, $request->dt_final])
                ->orderBy('dt_vencimento', 'asc')
                ->get();
        }

        return \PDF::loadView('relatorios.relatorio', compact('dados', 'request'))
            ->setPaper('a4', 'landscape')
            ->stream();
    }
}
