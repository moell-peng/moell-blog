@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $tag->tag_name)

@section('description', $systemPresenter->getKeyValue('seo_desc'))

@section('keywords', $systemPresenter->getKeyValue('seo_keyword'))

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12 article-info">
                <h3 class="to-animate fadeInUp animated">
                    <i class="glyphicon glyphicon-tags"></i>
                    &nbsp;{{ $tag->tag_name }}
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
