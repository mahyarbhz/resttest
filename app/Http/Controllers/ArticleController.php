<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        return response(Article::all()->toArray(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Article\PostRequest $request)
    {
        $data = $request->only(['title', 'description']);
        return response(Auth::user()->articles()->create($data), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return Article[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response(Article::all()->find($article), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return Article|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Article\PutRequest $request, Article $article)
    {
        if (Auth::user()->id != $article->user()->id) {
            return response(null, 403);
        }
        $article->update($request->only('title', 'description'));
        return response($article, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return Article|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if (Auth::user()->id != $article->user_id) {
            return response(null, 403);
        }
        $article->delete();
        return response(null, 204);
    }
}
