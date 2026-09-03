<?php

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

$apps = [
    [
        'id' => 1,
        'name' => 'Disc-Out',
        'description' => 'A desktop music player built with Electron.',
        'status' => 'In Development',
        'platforms' => [
            'Windows',
            'macOS',
            'Linux'
        ]
    ],

    [
        'id' => 2,
        'name' => 'UpBudget',
        'description' => 'A personal finance application.',
        'status' => 'In Development',
        'platforms' => [
            'Web'
        ]
    ]
];

echo json_encode(
    $apps,
    JSON_PRETTY_PRINT
);