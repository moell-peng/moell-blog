@extends('layouts.app')

@section('title', $keyword)

@section('description', $keyword)

@section('keywords', $keyword)

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12 article-info">
                <h3 class="to-animate fadeInUp animated">
                    <i class="glyphicon glyphicon-search"></i>
                    &nbsp;
                    {{ $keyword }}
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
