<?php

namespace App\Http\Controllers;
use App\Membership;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $articles = Membership::all();
        return response()->json($articles);
    }

    public function getArticle($id)
    {
        $article = Membership::find($id);
        return response()->json($article);
    }

    public function saveArticle(Request $request)
    {
        $article = Membership::create($request->all());
        return response()->json($article);
    }

    public function deleteArticle($id)
    {
        $article = Membership::find($id);
        $article->delete();
        return response()->json('success');
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Membership::find($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();
        return response()->json($article);
    }

}
