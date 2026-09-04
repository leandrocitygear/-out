<?php


header("Access-Control-Allow-Origin: https://out-omega-beryl.vercel.app");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle browser preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
    }
    
    header('Content-Type: application/json');
    
    header('Access-Control-Allow-Origin: *');
    
$apps = [
    [
        'id' => 1,
        'name' => 'Disc=out',
        'description' => 'A desktop music player built with Electron.',
        'status' => 'In Development',
        'platforms' => [
            'Windows',
            'macOS',
            'Ubuntu',
            'Fedora'
        ],

        'iconImage' => './icon_images/disc-out.png',

        'screenshots' => [
            './app_screenshots/disc-out-screenshots/Screenshot1.png',
            './app_screenshots/disc-out-screenshots/Screenshot2.png',
            './app_screenshots/disc-out-screenshots/Screenshot3.png',
            './app_screenshots/disc-out-screenshots/Screenshot4.png',
            './app_screenshots/disc-out-screenshots/Screenshot5.png',
            './app_screenshots/disc-out-screenshots/Screenshot6.png',
            './app_screenshots/disc-out-screenshots/Screenshot7.png',
            './app_screenshots/disc-out-screenshots/Screenshot8.png'
        ],

        'downloads' => [
            'Windows' => 'https://github.com/leandrocitygear/Music-Player/releases/download/v1.0.0/Disc-Out-Setup.exe',
            'macOS' => 'https://github.com/leandrocitygear/Music-Player/releases/download/v1.0.0/Disc-Out-macOS.dmg',
            'Ubuntu' => 'https://github.com/leandrocitygear/Music-Player/releases/download/v1.0.0/Disc-Out-Ubuntu.deb',
            'Fedora' => 'https://github.com/leandrocitygear/Music-Player/releases/download/v1.0.0/Disc-Out-Fedora.rpm'
        ]
    ]

    // [
    //     'id' => 2,
    //     'name' => 'UpBudget',
    //     'description' => 'A personal finance application.',
    //     'status' => 'In Development',
    //     'platforms' => [
    //         'Web'
    //     ]
    // ]
];

echo json_encode(
    $apps,
    JSON_PRETTY_PRINT
);