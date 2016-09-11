@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $systemPresenter->getKeyValue('title'))

@section('description', $systemPresenter->getKeyValue('seo_desc'))

@section('keywords', $systemPresenter->getKeyValue('seo_keyword'))

@section('header-text')
    <div class="text-inner text-center">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="to-animate fadeInUp animated">
                    {{ $systemPresenter->getKeyValue('motto') }}
                </h1>
                <div class="to-animate fadeInUp animated">
                    <?php
                    $github_url = $systemPresenter->getKeyValue('github_url');
                    $weibo_url = $systemPresenter->getKeyValue('weibo_url');
                    ?>
                    @if ($github_url != "")
                        <span class="icon-github" style="padding-left:20px;">
                            <a href='{{ $github_url }}' target="_blank">Github</a>
                        </span>
                    @endif
                    @if ($weibo_url != "")
                        <span class="icon-weibo" style="padding-left:20px;margin-left:10px;">
                            <a href='{{ $weibo_url }}' target="_blank">Weibo</a>
                        </span>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
