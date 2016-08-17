@extends('layouts.backend')

@section('title', '博客用户添加')

@section('header')
    <h1>
        博客用户添加
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" enctype="multipart/form-data" action="{{ url('backend/user') }}" id="user-form" >
                    <div class="box-body">
                        <div class="form-group">
                            <label for="user_pic">头像</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="file" name="user_pic" id="user_pic" accept="image/png,image/gif,image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">名字</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="name" id='name' placeholder='请输入名字'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">登录邮箱</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text" class='form-control' name="email" id="email" placeholder="请输入唯一的邮箱">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">登录密码</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="password" class='form-control' name="password" id="password" placeholder="请输入大于等于8位的密码">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{ csrf_field() }}


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">确定</button>
                        <button type="button" class="btn btn-warning" id="reset-btn">重置</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection