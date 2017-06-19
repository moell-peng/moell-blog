@extends('layouts.app')

@section('title', request('keyword'))

@section('description', request('keyword'))

@section('keywords', request('keyword'))

@section('header-text')
    <div class="text-inner">
        <div class="row">
            <div class="col-md-12">
                <h3 class="to-animate fadeInUp animated color-white">
                    <i class="glyphicon glyphicon-search"></i>
                    &nbsp;
                    {{ request('keyword') }}
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('default.article')
@endsection
