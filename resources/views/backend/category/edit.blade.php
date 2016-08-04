@extends('layouts.backend')

@section('title', '文章分类修改')

@section('header')
    <h1>
        文章分类修改
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                <form role="form" method="post" action="{{ url('backend/article') }}" id="category-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">分类名称</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="title" id='title' placeholder='请输入分类名称'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">上级分类</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <select id='cate_id' class='form-control'>
                                        <option value=''>请选择</option>
                                        <option value=''>请选择</option>
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