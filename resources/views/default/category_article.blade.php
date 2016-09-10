@inject('systemPresenter', 'App\Presenters\SystemPresenter')

@extends('layouts.app')

@section('title', $systemPresenter->checkReturnValue('title', $category->name))

@section('description', $systemPresenter->checkReturnValue('seo_desc', $category->name))

@section('keywords', $systemPresenter->checkReturnValue('seo_keyword', $category->name))

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12 article-info">
                <h3 class="to-animate fadeInUp animated">
                    <i class="glyphicon glyphicon-th-list"></i>
                    &nbsp;{{ $category->name }}
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
