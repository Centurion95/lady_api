<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Prueba extends Controller
{
    public function prueba(LoginRequest $request)
    {
        return "hola, si funciona";
    }
}
