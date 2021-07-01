<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tag as AppTag;

class GitserviceController extends Controller
{
    public function index(Request $request){
        $nomeRepo = $request->inputRepo;
        $url = "https://api.github.com/users/".$nomeRepo."/repos";
        $response = Http::get($url);
        $repos = $response->body();
        return response($repos);
    }

    public function createTag(Request $request){
        $request->validate([
            'name'      => ['required']
        ]);

        $tag = new AppTag();
        $tag->tag = $request->name;
        $tag->save();

        return response()->json($tag);
        // dd($request);
    }
}
