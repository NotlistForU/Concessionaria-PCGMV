<?php

/**
 * Valida o número da CNH brasileira (Carteira Nacional de Habilitação)
 * com base no algoritmo oficial do Detran.
 *
 * @param string $cnh Número da CNH
 * @return bool True se a CNH for válida, False caso contrário
 */
function validar_cnh($cnh) {
    // Sanitização: remove tudo que não for número
    $cnh = preg_replace('/[^0-9]/', '', $cnh);

    // Edge Case: Verifica se possui 11 dígitos
    if (strlen($cnh) != 11) {
        return false;
    }

    // Edge Case: Verifica se todos os números são iguais (ex: 11111111111)
    if (preg_match('/^(\d)\1*$/', $cnh)) {
        return false;
    }

    // Pega os 9 primeiros dígitos
    $base = substr($cnh, 0, 9);
    
    // Pega os 2 dígitos verificadores informados
    $dv1_informado = (int) $cnh[9];
    $dv2_informado = (int) $cnh[10];

    // ==========================================
    // Cálculo do Primeiro Dígito Verificador (DV1)
    // ==========================================
    $soma1 = 0;
    $peso1 = 9;
    
    for ($i = 0; $i < 9; $i++) {
        $soma1 += (int)$base[$i] * $peso1;
        $peso1--;
    }

    $resto1 = $soma1 % 11;
    $incremento_dv2 = 0;

    if ($resto1 >= 10) {
        $dv1_calculado = 0;
        $incremento_dv2 = 2;
    } else {
        $dv1_calculado = $resto1;
    }

    // ==========================================
    // Cálculo do Segundo Dígito Verificador (DV2)
    // ==========================================
    $soma2 = 0;
    $peso2 = 1;
    
    for ($i = 0; $i < 9; $i++) {
        $soma2 += (int)$base[$i] * $peso2;
        $peso2++;
    }

    $resto2 = $soma2 % 11;
    $dv2_calculado = $resto2 - $incremento_dv2;

    if ($dv2_calculado < 0) {
        $dv2_calculado += 11;
    }
    
    if ($dv2_calculado >= 10) {
        $dv2_calculado = 0;
    }

    // Retorna true apenas se os dois DVs calculados baterem com os informados
    return ($dv1_informado === $dv1_calculado && $dv2_informado === $dv2_calculado);
}

/**
 * Valida o número de WhatsApp / celular brasileiro
 * com base no DDD e no padrão de 11 dígitos.
 *
 * @param string $whatsapp Número do WhatsApp/Celular
 * @return bool True se for um número válido, False caso contrário
 */
function validar_whatsapp($whatsapp) {
    // Sanitização: remove tudo que não for número
    $whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);

    // Edge Case: Verifica se possui 11 dígitos (padrão celular: DDD + 9 + 8 dígitos)
    if (strlen($whatsapp) !== 11) {
        return false;
    }

    // Edge Case: Verifica se todos os números são iguais (ex: 11111111111)
    if (preg_match('/^(\d)\1*$/', $whatsapp)) {
        return false;
    }

    // Valida o DDD (primeiros dois dígitos): deve ser entre 11 e 99 (excluindo os que terminam com 0)
    $ddd = (int) substr($whatsapp, 0, 2);
    if ($ddd < 11 || $ddd > 99 || $ddd % 10 === 0) {
        return false;
    }

    // Valida o nono dígito (deve ser 9 para celular brasileiro)
    if ($whatsapp[2] !== '9') {
        return false;
    }

    return true;
}

// ==========================================
// Testes (Pode remover em produção se desejar)
// ==========================================
// var_dump(validar_cnh("12345678912")); // Teste: Falso (Dígitos incorretos)
// var_dump(validar_cnh("111.111.111-11")); // Teste: Falso (Formato inválido / Todos iguais)
// var_dump(validar_cnh("04432168936")); // Teste: Verdadeiro (CNH Válida, gerada para teste)
