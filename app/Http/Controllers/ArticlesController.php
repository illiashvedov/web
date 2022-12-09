<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticlesController extends Controller
{
    public function index()
    {
        return response()->json(Article::all());
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request)
    {
        $model = Article::create($request->all());
        return redirect()->route('articles.show', [$model]);
    }

    public function show(int $article)
    {
        $articleModel = Article::find($article);

        if (!$articleModel) {
            throw new NotFoundHttpException('Not found');
        }

        return response()->json(['data' => $articleModel]);
    }
}
