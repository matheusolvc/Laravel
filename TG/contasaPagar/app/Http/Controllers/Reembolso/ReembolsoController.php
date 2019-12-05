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
        // $reembolsos  = Conta::where('tipo_conta', '=', 'R')->paginate(7);
        // return view('contas.reembolso.index', compact('reembolsos'));
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

        $reembolso = new Conta();
        $reembolso->tipo_conta = 'R';
        $reembolso->status = 'Pendente';
        $reembolso->num_doc = '0';
        $reembolso->dt_emissao = Carbon::now();
        $reembolso->multa = 0;
        $reembolso->juros = 0;
        $reembolso->dt_recibo = $request->dt_recibo;
        $reembolso->valor_documento = $request->valor_documento;
        $reembolso->descricao = $request->descricao;
        $reembolso->dt_criacao = Carbon::now();
        $reembolso->id_usuario = Auth::user()->id;

        // if ($request->hasFile('anexo')) {
        //     $image = $request->file('anexo');
        //     $name = Auth::user()->id.'_' . $reembolso->id_grupo . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = base_path('public/files/reembolsos');
        //     $image->move($destinationPath, $name);

        //     $reembolso->img = asset('files/reembolsos') . '/' . $name;
        // }

        $reembolso->save();

        return redirect('reembolso/create')
            ->with('message', 'reembolso criado com sucesso.');
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
        $reembolso = Conta::FindOrFail($id);
        return view('reembolso.solicitacoes.edit', compact('reembolso'));
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
        $reembolso->update();

        return redirect('/reembolso/edit/' . $id)
            ->with('message', 'reembolso alterado com sucesso.');
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

        return redirect('reembolso/solicitacoes')
            ->with('message', 'reembolso excluido com sucesso.');
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
