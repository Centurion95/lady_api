<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index()
    {
        return "hola, si funciona";
    }

    public function prueba_1()
    {
        return "hola, si funciona: prueba_1";
    }
}
