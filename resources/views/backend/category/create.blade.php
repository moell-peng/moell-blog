@extends('layouts.backend')

@section('title', '文章分分类添加')

@section('header')
    <h1>
        文章分分类添加
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" action="{{ url('backend/category') }}" id="category-form">
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
                            <label for="cate_id">上级分类</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    @inject('category', 'App\Presenters\CategoryPresenter')
                                    {!! $category->getSelect(0, '顶级分类') !!}
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