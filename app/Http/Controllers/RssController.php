<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\System;
use Rss;

class RssController extends Controller
{
    public function index()
    {
        $channel = [
            'title' => System::keyValue('title'),
            'link'  => route('rss'),
            'description' => $this->stringFormat(System::keyValue('seo_desc')),
        ];

        $rss = Rss::channel($channel);

        $articles = Article::query()->orderBy('id', 'desc')->simplePaginate(20);
        if ($articles) {
            foreach ($articles as $article) {
                $item = [
                    'title' => $article->title,
                    'description' => $this->stringFormat($article->desc),
                    'link' => route('article', ['id' => $article->id]),
                    'pubDate' => date('Y-m-d', strtotime($article->created_at))
                ];

                $rss->item($item);
            }
        }

        return response($rss, 200, ['Content-Type' => 'text/xml']);
    }

    private function stringFormat($string)
    {
        return sprintf("<![CDATA[%s]]>", $string);
    }
}
