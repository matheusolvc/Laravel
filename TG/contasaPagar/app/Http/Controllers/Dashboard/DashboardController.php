<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Conta;
use Faker\Generator;

class DashboardController extends Controller
{
    public function index()
    {
            $chartjs = $this->gerarGrafico('D');

            $qtde_vencidas = Conta::where('status', '=', 'A')
                ->where('dt_vencimento', '<', Carbon::now())
                ->where('tipo_conta', '<>', 'R')
                ->count();

            $qtde_reembolso = Conta::where('status', '=', 'A')
                ->where('tipo_conta', '=', 'R')
                ->count();

            return view('dashboard.dashboard', compact('chartjs', 'qtde_vencidas', 'qtde_reembolso'));
    }

    private function gerarGrafico($filtro)
    {
        $labels = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
        $dados = array();

        $data = array();

        // $ultimo_domingo = \Carbon\Carbon::lastDay('')

        $contas = Conta::where('status', '=', 'P')
            ->whereBetween('dt_pagamento', [Carbon::now()->subDays(7), Carbon::now()])
            ->get();

        foreach($contas as $conta){
            array_push($dados, $conta->valor_documento);
        }

        return app()->chartjs
                ->name('lineChartTest')
                ->type('line')
                ->size(['width' => 900, 'height' => 380])
                ->labels($labels)
                ->datasets([
                    [
                        "label" => "Semana",
                        'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => $dados,
                    ]
                ])
                ->options([]);
    }

    public function charts($filtro)
    {
        $chartjs = $this->gerarGrafico($filtro);

        return view('dashboard.dashboard', compact('chartjs'));
    }
}
