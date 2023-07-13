<?php
/* Configuração de Rotas Alternativas da Aplicação */
/* ROTEAMENTO URL x Controller <-> Action */
$routes = [    
    "quiz" => "Index:viewQuiz",
    "info" => "Index:viewInfo",
    "video" => "Index:viewVideo",
    "agradecimentos" => "Index:agradecimentos",
    'tentar-novamente' => 'Index:tentar_novamente',
    'termos' => 'Index:termos',
];

/* URLS IGNORADAS PELO LOADER/GETROUTE/REGISTRY */
$ignore = ["page"];

/*PATHS OPCIONAIS*/
$paths = ['fotos' => DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'foto'];
