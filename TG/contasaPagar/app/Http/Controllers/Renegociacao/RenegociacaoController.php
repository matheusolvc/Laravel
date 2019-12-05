<?php

namespace App\Http\Controllers\Renegociacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renegociacao;

class RenegociacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $renegociacoes  = Renegociacao::where('tipo_conta', '=', 'V')->paginate(7);
        return view('contas.renegociacoes.index', compact('renegociacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $renegociacao = new Renegociacao();
        $renegociacao->id_conta = $id;

        return view('contas.renegociacao.create', compact('renegociacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $renegociacao = new Renegociacao();
        $renegociacao->save();

        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
    }

    public function edit($id)
    {
        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
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
        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route()
            ->with('message', 'Renegociação realizada com sucesso.');
    }
}
