@extends('layouts.backend')

@section('title', '导航添加')

@section('header')
    <h1>
        导航添加
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" action="{{ url('backend/navigation') }}" id="navigation-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">分类名称</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="name" id='name' placeholder='请输入分类名称'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="url" id='url' placeholder='请输入合法链接地址'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sequence">显示顺序</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="0" class='form-control' name="sequence" id='sequence' placeholder='请输入整形的数值'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="state">状态</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <select name="state" id="state" class="form-control">
                                        <option value="0">显示</option>
                                        <option value="1">隐藏</option>
                                    </select>
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