<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">热门文章</div>

    @inject('hotArticle', 'App\Presenters\ArticlePresenter')

    <?php $hotArticleList = $hotArticle->hotArticleList(); ?>
    <!-- List group -->
    <ul class="list-group">
        @if ($hotArticleList)
            @foreach ($hotArticleList as $hal)
                <li class="list-group-item">
                    <a href="{{ route('article', ['id' => $hal->id]) }}" target="_blank">
                        {{ $hotArticle->formatTitle($hal->title) }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>