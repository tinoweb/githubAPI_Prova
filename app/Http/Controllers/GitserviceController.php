<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tag as AppTag;
use App\Models\Repotag;

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
            'name'      => ['required', 'regex:/^\S*$/u']
        ]);

        $tag = new AppTag();
        $tag->tag = $request->name;
        $tag->save();

        return response()->json($tag);
    }

    public function getTags(){
        $tags = AppTag::orderBy('id', 'desc')->get();
        return response($tags);
    }

    public function setTag(Request $request){
        $tag = AppTag::where('id', $request->tag)->first();
        
        $repoName = $request->repoName;
        $owner = $request->owner;
        $tagName = $tag->tag;

        $url = "https://api.github.com/repos/".$owner."/".$repoName."/git/refs";
        $response = Http::get($url);
        $resposta = json_decode($response->body(), true);

        if ( isset($resposta['message']) && $resposta['message'] != "ok" ) {
            return response()->json(['msg' => $resposta['message']]);
        }else{
            // dd($resposta[0]['object']['sha']);
            $hash = $resposta[0]['object']['sha'];
            $urlPost = "https://api.github.com/repos/".$owner."/".$repoName."/git/tags";

            $responsePost = Http::withBasicAuth('tino477@gmail.com', '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')->post($urlPost, [
                'tag' => $tagName,
                'message' => $request->name,
                'object' => $hash,
                'type' => 'commit',
            ]);
            $respostaPost = json_decode($responsePost->body(), true);

            if (isset($respostaPost['node_id'])) {
                $tagRep = new Repotag();
                $tagRep->tag_id  = $request->tag;
                $tagRep->message = $respostaPost['message'];
                $tagRep->sharepo = $respostaPost['sha'];
                $tagRep->url     = $respostaPost['url'];
                $tagRep->tagrepo = $respostaPost['tag'];
                $salvo = $tagRep->save();
                if ($salvo) {
                    return response()->json(['msg' => 'certo']);
                }
            }else{
                // dd("caiu aki");
                return response()->json(['msg' => $responsePost['message']]);
            }
        }
    }
    
    public function getAttrTags(){
        $todos = Repotag::all();
        return response($todos);
    }
}



