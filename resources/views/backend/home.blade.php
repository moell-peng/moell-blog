@extends('layouts.backend')

@section('title', 'Moell Blog')

@section('header')
    <h1>
        Home
        <small>Moell Blog</small>
    </h1>
@endsection

@section('content')
    <style>
        p {
            text-indent: 10px;
        }
    </style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid" style="padding: 10px;">
                <h3>欢迎使用Moell Blog!</h3>
                <strong>简介</strong>
                <p> Moell Blog 是一个基于Laravel开发，支持markdown语法开源的简易博客。</p>
                <strong>开发者信息</strong>
                <p>Name : moell</p>
                <p>Email : moell91@foxmail.com</p>
                <p>博客地址 : <a href="http://moell.cn" target="_blank">moell</a></p>
                <p>项目地址 : <a href="https://github.com/moell-peng/moell-blog" target="_blank">Github</a></p>

                <strong>依赖开源程序</strong>
                <ul>
                    <li>LAMP</li>
                    <li>
                        <a href="https://laravel.com/" target="_blank">Laravel</a>
                    </li>
                    <li>
                        <a href="https://www.almsaeedstudio.com" target="_blank">
                            AdminLTE
                        </a>
                    </li>
                    <li>
                        <a href="http://getbootstrap.com/" target="_blank">
                            Bootstrap
                        </a>
                    </li>
                    <li>
                        <a href="https://pandao.github.io/editor.md/examples/index.html" target="_blank">
                            Editor.md
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/andersao/l5-repository" target="_blank">
                            andersao/l5-repository
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/etrepat/baum" target="_blank">
                            etrepat/baum
                        </a>
                    </li>
                </ul>
                <strong>关于问题反馈</strong>
                <p>
                    可以发送Email,或者在Github上反馈遇到的问题,看到后会逐一帮助解决问题，务必将问题描述清楚。
                </p>
            </div>
        </div>
    </div>
@endsection