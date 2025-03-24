<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    public function index()
    {

        return view('index');
    }
}
?>