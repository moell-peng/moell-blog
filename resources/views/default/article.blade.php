@if($articles)
    <ol class="article-list">
        {{--@inject('userPresenter', 'App\Presenters\UserPresenter')--}}
        @inject('catePresenter', 'App\Presenters\CategoryPresenter')
        @foreach ($articles as $article)
            <li class="article-list-item">
                <h4 class='title'>
                    <a href="{{ route('article',['id' => $article->id]) }}" target="_blank">
                        {{$article->title}}
                    </a>
                </h4>
                <p class="desc">
                   {{$article->desc}}
                </p>
                <p style="margin-top:15px;">
                    <span>
                        <i class="glyphicon glyphicon-calendar"></i>{{ date('Y-m-d', strtotime($article->created_at)) }}
                    </span>
                            &nbsp;
                    {{--<span>
                        <i class="glyphicon glyphicon-user"></i> {{ $userPresenter->getUserName($article->user_id) }}
                    </span>
                            &nbsp;--}}
                    <span>
                        <i class="glyphicon glyphicon-th-list"></i>
                        <a href="{{ route('category', ['id' => $article->cate_id]) }}" target="_blank">
                            {{ $catePresenter->getIdName($article->cate_id) }}
                        </a>
                    </span>
                    <span style="float:right">
                        <i class="glyphicon glyphicon-eye-open"></i> {{ $article->read_count }} views
                    </span>
                </p>
            </li>
        @endforeach
    </ol>
    {!! $articles->links() !!}
@else
    <h3>没有文章哟！！！</h3>
@endif