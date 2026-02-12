<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaCpf implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove tudo que não for número
        $cpf = preg_replace('/\D/', '', $value);

        // Deve ter exatamente 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Bloqueia CPFs inválidos conhecidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Cálculo dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Informe um CPF válido com exatamente 11 dígitos.';
    }
}