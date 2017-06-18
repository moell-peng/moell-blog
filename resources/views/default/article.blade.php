@if($articles)
    <ol class="article-list">
        @inject('catePresenter', 'App\Presenters\CategoryPresenter')
        @foreach ($articles as $article)
            <li>
                <h4 class='title'>
                    <a href="{{ route('article',['id' => $article->id]) }}" target="_blank">
                        {{$article->title}}
                    </a>
                </h4>
                <p class="desc">
                   {{$article->desc}}
                </p>
                <p class="info">
                    <span>
                        <i class="glyphicon glyphicon-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}
                    </span>
                            &nbsp;
                    <span>
                        {!! $catePresenter->getIdLink($article->cate_id) !!}
                    </span>
                    <span>
                        <i class="glyphicon glyphicon-eye-open"></i> {{ $article->read_count }} views
                    </span>
                </p>
            </li>
            <hr/>
        @endforeach
    </ol>
    {!! $articles->links() !!}
@else
    <h3>没有文章哟！！！</h3>
@endif