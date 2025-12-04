<?php
// Configuração de dados por domínio
$dominios = [
    'seudireitobrasil.shop' => [
        'nome_empresa' => 'GUIA DE JOINVILLE LTDA',
        'cnpj' => '95.793.717/0001-44',
        'endereco' => 'R Gustavo Grossembacher, 83 - Sala B',
        'bairro' => 'Centro',
        'cidade' => 'Joinville',
        'estado' => 'SC',
        'cep' => '89201-230',
        'telefone' => '(47) 98117-8064',
        'telefone_link' => '5547981178064',
        'email' => 'proconta@netiville.com.br',
        'nome_fantasia' => 'Tropical Açaí'
    ],
    // Adicione outros domínios aqui conforme necessário
    'localhost' => [
        'nome_empresa' => 'GUIA DE JOINVILLE LTDA',
        'cnpj' => '95.793.717/0001-44',
        'endereco' => 'R Gustavo Grossembacher, 83 - Sala B',
        'bairro' => 'Centro',
        'cidade' => 'Joinville',
        'estado' => 'SC',
        'cep' => '89201-230',
        'telefone' => '(47) 98117-8064',
        'telefone_link' => '5547981178064',
        'email' => 'proconta@netiville.com.br',
        'nome_fantasia' => 'Tropical Açaí'
    ]
];

// Identificar domínio atual
$dominio_atual = $_SERVER['HTTP_HOST'] ?? 'localhost';
$dominio_atual = preg_replace('/^www\./', '', $dominio_atual); // Remove www.

// Pegar dados do domínio ou usar padrão
$empresa = $dominios[$dominio_atual] ?? $dominios['localhost'];
