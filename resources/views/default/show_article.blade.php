@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $systemPresenter->checkReturnValue('title', $article->title))

@section('description', $systemPresenter->checkReturnValue('seo_desc', $article->desc))

@section('keywords', $systemPresenter->checkReturnValue('seo_keyword', $article->keyword))

@section('style')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('share.js/css/share.min.css') }}">
@endsection

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12 article-info">
                <h3 class="to-animate fadeInUp animated">
                    {{ $article->title }}
                </h3>

                <p class="to-animate fadeInUp animated" style="margin-top:10px;">
                    {{ $article->desc }}
                </p>

                <p class="to-animate fadeInUp animated">
                    <i class="glyphicon glyphicon-calendar"></i>{{ $article->created_at }}
                    &nbsp;
                    <i class="glyphicon glyphicon-user"></i>{{ $user->name }}
                </p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="markdown-body editormd-html-preview" style="padding:0;">
        {!! $article->html_content !!}
    </div>

    <div class="panel panel-default" style="margin-top:10px;">
        <div>
            <div id="share" class="social-share"></div>
        </div>
        <div class="panel-body">
            @if($category)
                <p>分类:
                    <i class="glyphicon glyphicon-th-list"></i>

                    <a href="{{ route('category', ['id' => $category->id]) }}" target="_blank">
                        {{ $category->name }}
                    </a>

                </p>
            @endif
            @if ($tags)
                <p>标签:
                    <i class="glyphicon glyphicon-tags"></i>&nbsp;
                    @foreach ($tags as $tag)
                        <a href="{{ route('tag', ['id' => $tag->id]) }}" target="_blank">
                            {{ $tag->tag_name }} &nbsp;
                        </a>
                    @endforeach
                </p>
            @endif
        </div>
    </div>
    <!-- 评论插件 -->
    @include('default.comment.index', [
        'commentId' => $article->id,
        'commentTitle' => $article->title,
        'commentUrl' => Request::getUri()
    ])
@endsection

@section('script')
    <script src="{{ asset('share.js/js/jquery.share.min.js') }}"></script>

    <script>
        $(function(){
            $('#share').share({sites: ['qzone', 'qq', 'weibo','wechat']});
        });
    </script>

@endsection
