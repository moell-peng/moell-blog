@extends('layouts.backend')

@section('title', '文章标签修改')

@section('header')
    <h1>
        文章标签修改
    </h1>
@endsection

@section('content')
    <div class="row">
        @include('backend.alert.warning')
        <div class="col-xs-12">
            <div class="box box-solid">
                <form role="form" method="post" action="{{ route('backend.tag.update', ['id' => $tag->id]) }}" id="tag-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">标签名称</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $tag->tag_name }}" class='form-control' name="name" id='name' placeholder='请输入标签名称'>
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