@extends('layouts.app')

@section('title', 'Moell Blog')

@section('description', 'Moell Blog')

@section('keywords', 'Moell Blog')

@section('header-text')
    <div class="text-inner text-center">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="to-animate fadeInUp animated">做努力的自己</h1>
                <div class="to-animate fadeInUp animated">
                    <a href=''>github</a>
                    <a href=''>web</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
