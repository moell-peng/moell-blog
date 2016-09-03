@extends('layouts.backend')

@section('title', '导航修改')

@section('header')
    <h1>
        导航修改
    </h1>
@endsection

@section('content')
    <div class="row">
        @include('backend.alert.warning')
        <div class="col-xs-12">
            <div class="box box-solid">
                <form role="form" method="post" action="{{ route('backend.navigation.update', ['id' => $navigation->id]) }}" id="navigation-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">分类名称</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $navigation->name }}" class='form-control' name="name" id='name' placeholder='请输入分类名称'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $navigation->url }}" class='form-control' name="url" id='url' placeholder='请输入合法链接地址'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sequence">显示顺序</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $navigation->sequence }}" class='form-control' name="sequence" id='sequence' placeholder='请输入整形的数值'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="state">状态</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <select name="state" id="state" class="form-control">
                                        <option value="0" {{ $navigation->state == 0 ? 'selected' : '' }}>显示</option>
                                        <option value="1" {{ $navigation->state == 1 ? 'selected' : '' }}>隐藏</option>
                                    </select>
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