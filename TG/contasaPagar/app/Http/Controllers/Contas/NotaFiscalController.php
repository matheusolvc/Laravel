<?php

namespace App\Http\Controllers\Contas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notasFiscais  = Conta::where('tipo_conta', '=', 'N')
            ->orderBy('dt_vencimento', 'asc')
            v
            ->paginate(7);

            return view('contas.notas-fiscais.index', compact('notasFiscais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contas.notas-fiscais.create');
    }

    public function migrar()
    {
        factory(\App\Models\Conta::class, rand(1,8))->state('notaFiscal')->create();

        return redirect()->route('contas.notas-fiscais.index')
            ->with('message', 'Contas migradas com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notaFiscal = Conta::FindOrFail($id);
        $notaFiscal->dt_emissao = date('d/m/Y', strtotime($notaFiscal->dt_emissao));
        $notaFiscal->dt_vencimento = date('d/m/Y', strtotime($notaFiscal->dt_vencimento));

        return view('contas.notas-fiscais.edit', compact('notaFiscal'));
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
        $notaFiscal = Conta::FindOrFail($id);
        $notaFiscal->dt_emissao = date('Y-m-d', strtotime($request->dt_emissao));
        $notaFiscal->dt_vencimento = date('Y-m-d', strtotime($request->dt_vencimento));;
        $notaFiscal->valor_documento = $request->valor_documento;
        $notaFiscal->multa = $request->multa;
        $notaFiscal->juros = $request->juros;
        $notaFiscal->dt_alteracao = Carbon::now();
        $notaFiscal->id_usuario = Auth::user()->id;
        $notaFiscal->update();

        return redirect()->route('contas.notas-fiscais.edit', ['id' => $id])
            ->with('message', 'Nota Fiscal alterada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notaFiscal = Conta::FindOrFail($id);
        $notaFiscal->delete();

        return redirect()->route('contas.notas-fiscais.index')
            ->with('message', 'Nota Fiscal excluida com sucesso.');
    }
}
