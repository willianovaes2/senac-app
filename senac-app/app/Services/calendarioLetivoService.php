<?php

namespace App\Services;

use Carbon\Carbon;

class CalendarioLetivoService
{
    public function calcularDataFinal(
        $dataInicio,
        array $diasSemana,
        int $cargaHorariaTotal,
        int $horasPorDia
    ) {
        $data = Carbon::parse($dataInicio);
        $horasAcumuladas = 0;

        // Normaliza diasSemana para minúsculas
        $diasSemana = array_map(fn($d) => strtolower($d), $diasSemana);

        while ($horasAcumuladas < $cargaHorariaTotal) {

            $ano = $data->year;
            $feriados = $this->getFeriados($ano);

            $diaSemana = strtolower($data->locale('pt_BR')->dayName);

            // Verifica se o dia é válido
            if (
                in_array($diaSemana, $diasSemana) &&
                !$data->isSunday() &&
                !$this->isUltimaSexta($data) &&
                !in_array($data->toDateString(), $feriados)
            ) {
                $horasAcumuladas += $horasPorDia;
            }

            if ($horasAcumuladas < $cargaHorariaTotal) {
                $data->addDay();
            }
        }

        return $data->format('Y-m-d');
    }

    private function isUltimaSexta(Carbon $data)
    {
        return $data->isFriday() && $data->copy()->addWeek()->month != $data->month;
    }

    private function getFeriados(int $ano)
    {
        $fixos = [
            "$ano-01-01",
            "$ano-04-21",
            "$ano-05-01",
            "$ano-09-07",
            "$ano-10-12",
            "$ano-11-02",
            "$ano-11-15",
            "$ano-12-25",
            "$ano-07-09", // SP
            "$ano-08-20", // SBC
        ];

        $pascoa = Carbon::createMidnightDate($ano, 3, 21)
            ->addDays(easter_days($ano));

        $moveis = [
            $pascoa->copy()->subDays(47)->toDateString(), // Carnaval
            $pascoa->copy()->subDays(2)->toDateString(),  // Sexta-feira Santa
            $pascoa->copy()->addDays(60)->toDateString(), // Corpus Christi
        ];

        return $this->aplicarEmendas(array_merge($fixos, $moveis));
    }

    private function aplicarEmendas(array $feriados)
    {
        $emendas = [];

        foreach ($feriados as $dataStr) {
            $data = Carbon::parse($dataStr);

            // Se feriado cair terça, adiciona segunda como feriado emenda
            if ($data->isTuesday()) {
                $emendas[] = $data->copy()->subDay()->toDateString();
            }

            // Se feriado cair quinta, adiciona sexta como feriado emenda
            if ($data->isThursday()) {
                $emendas[] = $data->copy()->addDay()->toDateString();
            }
        }

        return array_unique(array_merge($feriados, $emendas));
    }

    public function listarDatasLetivas(
        $dataInicio,
        $dataFim,
        array $diasSemana
    ) {
        $data = Carbon::parse($dataInicio);
        $fim  = Carbon::parse($dataFim);
        $datas = [];

        $diasSemana = array_map(fn($d) => strtolower($d), $diasSemana);

        while ($data->lte($fim)) {
            $ano = $data->year;
            $feriados = $this->getFeriados($ano);
            $diaSemana = strtolower($data->locale('pt_BR')->dayName);

            if (
                in_array($diaSemana, $diasSemana) &&
                !$data->isSunday() &&
                !$this->isUltimaSexta($data) &&
                !in_array($data->toDateString(), $feriados)
            ) {
                $datas[] = $data->toDateString();
            }

            $data->addDay();
        }

        return $datas;
    }
}
