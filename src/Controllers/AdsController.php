<?php

namespace App\Controllers;

use App\Components\Database;

class AdsController
{
    public function index()
    {
        $db = new Database();
        var_dump($db);
    }

    public function store()
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
    }

    public function update(int $id)
    {
        var_dump(dirname(dirname(__DIR__)));
    }
}
