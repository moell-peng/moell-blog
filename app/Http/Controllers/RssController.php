<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryEloquent;
use App\Repositories\SystemRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Rss;

class RssController extends Controller
{
    private $article;
    private $system;

    public function __construct(ArticleRepositoryEloquent $article, SystemRepositoryEloquent $system)
    {
        $this->article = $article;
        $this->system = $system;
    }

    public function index()
    {
        $title = $this->system->getKeyValue('title');
        $description = $this->stringFormat($this->system->getKeyValue('seo_desc'));

        $channel = [
            'title' => $title,
            'link'  => route('rss'),
            'description' => $description,
        ];

        $rss = Rss::channel($channel);

        $articles = $this->article->orderBy('id', 'desc')->simplePaginate(20);
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
