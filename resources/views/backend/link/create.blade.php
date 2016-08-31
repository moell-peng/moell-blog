@extends('layouts.backend')

@section('title', '友情链接添加')

@section('header')
    <h1>
        友情链接添加
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" action="{{ url('backend/link') }}" id="link-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">链接名称</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="name" id='name' placeholder='请输入链接名称'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="url" id='url' placeholder='请输入以http或https合法的链接'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sequence">顺序</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="sequence" id='sequence' placeholder='请输入链接顺序'>
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