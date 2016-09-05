@extends('layouts.app')

@section('title', $category->name)

@section('description', $category->name)

@section('keywords', $category->name)

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
