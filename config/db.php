<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => env('DB_DRIVER') . ':host=' . env('DB_HOST') . ';dbname=' . env('DB_NAME'),
    'username' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'charset' => 'utf8',
];

