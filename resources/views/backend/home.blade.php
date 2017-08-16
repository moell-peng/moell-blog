@extends('layouts.backend')

@section('title', 'Fenglei Blog')

@section('header')
    <h1>
        Home
        <small>Feng Lei Blog</small>
    </h1>
@endsection

@section('content')
    <style>
        p {
            text-indent: 10px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">系统信息</h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>服务器域名： {{ $systemInfo['hostName'] }}</td>
                                </tr>
                                <tr>
                                    <td>PHP版本： {{ $systemInfo['phpVersion'] }}</td>
                                </tr>
                                <tr>
                                    <td>服务器端信息：{{ $systemInfo['runOS'] }}/{{ $systemInfo['serverInfo'] }}</td>
                                </tr>
                                <tr>
                                    <td>最大上传限制：{{ $systemInfo['maxUploadSize'] }}</td>
                                </tr>
                                <tr>
                                    <td>最大执行时间：{{ $systemInfo['maxExecutionTime'] }} seconds</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection