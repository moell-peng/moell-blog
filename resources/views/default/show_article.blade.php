@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $systemPresenter->checkReturnValue('title', $article->title))

@section('description', $systemPresenter->checkReturnValue('seo_desc', $article->desc))

@section('keywords', $systemPresenter->checkReturnValue('seo_keyword', $article->keyword))

@section('style')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.preview.min.css') }}">
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

    <div class="panel panel-default" style="margin-top:5px;">
        <div class="panel-body">
            <p>分类:
                <i class="glyphicon glyphicon-th-list"></i>
                <a href="{{ route('category', ['id' => $category->id]) }}" target="_blank">
                    {{ $category->name }}
                </a>
            </p>
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
@endsection

@section('script')
    <script src="{{ asset('editor.md/lib/marked.min.js') }}"></script>
    <script src="{{ asset('editor.md/lib/prettify.min.js') }}"></script>

    <script src="{{ asset('editor.md/lib/raphael.min.js') }}"></script>
    <script src="{{ asset('editor.md/lib/underscore.min.js') }}"></script>
    <script src="{{ asset('editor.md/lib/sequence-diagram.min.js') }}"></script>
    <script src="{{ asset('editor.md/lib/flowchart.min.js') }}"></script>
    <script src="{{ asset('editor.md/lib/jquery.flowchart.min.js') }}"></script>

    <script src="{{ asset('editor.md/editormd.min.js') }}"></script>
    {{--<<script>
        $(function(){
            editormd.markdownToHTML("content-markdown", {
                //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                htmlDecode      : "style,script,iframe",  // you can filter tags decode
                //toc             : false,
                //tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                //gfm             : false,
                //tocDropdown     : true,
                // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                emoji           : true,
                taskList        : true,
                tex             : true,  // 默认不解析
                flowChart       : true,  // 默认不解析
                sequenceDiagram : true,  // 默认不解析
                theme : "dark",
                previewTheme : "dark",
                editorTheme : "pastel-on-dark",

            });
        });
    </script>--}}
@endsection
