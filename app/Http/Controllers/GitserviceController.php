<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GitserviceController extends Controller
{
    public function index(Request $request){
        $nomeRepo = $request->inputRepo;
        
        $url = "https://api.github.com/users/".$nomeRepo."/repos";
        $response = Http::get($url);
        $repos = $response->body();
        return response($repos);
    }
}
