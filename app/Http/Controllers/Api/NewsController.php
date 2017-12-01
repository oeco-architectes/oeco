<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    public function index()
    {
        return News::all();
    }

    public function show(News $news)
    {
        return $news;
    }

    public function store(Request $request)
    {
        $news = News::create($request->all());
        return response()->json($news, 201);
    }

    public function update(Request $request, News $news)
    {
        $news->update($request->all());
        return response()->json($news, 200);
    }

    public function delete(News $news)
    {
        $news->delete();
        return response()->json(null, 204);
    }
}
