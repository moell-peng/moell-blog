@extends('layouts.backend')

@section('title', '博客用户修改')

@section('header')
    <h1>
        博客用户修改
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" enctype="multipart/form-data" action="{{ route('backend.user.update', ['id' => $user->id]) }}" id="edit-user-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="user_pic">头像</label>
                            <div class="row">
                                <div class='col-md-3'>
                                    <input type="file" name="user_pic" id="user_pic" accept="image/png,image/gif,image/jpeg" >
                                </div>
                                <div class='col-md-6'>
                                    <img src="{{ asset('uploads/avatar') }}/{{ $user->user_pic }}" class="img-circle" style="width:80px;height:auto;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">名字</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $user->name }}" class='form-control' name="name" id='name' placeholder='请输入名字'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">登录邮箱</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text" value="{{ $user->email }}" class='form-control' name="email" id="email" placeholder="请输入唯一的邮箱">
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
                    {{ method_field('PUT') }}


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