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

        while ($horasAcumuladas < $cargaHorariaTotal) {

            $ano = $data->year;
            $feriados = $this->getFeriados($ano);

            $diaSemana = strtolower($data->locale('pt_BR')->dayName);

            if (
                in_array($diaSemana, $diasSemana) &&
                !in_array($data->toDateString(), $feriados) &&
                !$this->isUltimaSexta($data)
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
        return $data->isFriday() &&
            $data->copy()->addWeek()->month != $data->month;
    }

    private function getFeriados($ano)
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

        // ✅ PASCOA CORRETA
        $pascoa = Carbon::createFromTimestamp(easter_date($ano));

        $moveis = [
            $pascoa->copy()->subDays(47)->toDateString(), // Carnaval
            $pascoa->copy()->subDays(2)->toDateString(),  // Sexta-feira Santa
            $pascoa->copy()->addDays(60)->toDateString(), // Corpus Christi
        ];

        return $this->aplicarEmendas(array_merge($fixos, $moveis));
    }

    private function aplicarEmendas(array $feriados)
    {
        $extras = [];

        foreach ($feriados as $dataStr) {

            $data = Carbon::parse($dataStr);

            if ($data->isTuesday()) {
                $extras[] = $data->copy()->subDay()->toDateString();
            }

            if ($data->isThursday()) {
                $extras[] = $data->copy()->addDay()->toDateString();
            }
        }

        return array_unique(array_merge($feriados, $extras));
    }
}