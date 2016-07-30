@extends('layouts.backend')

@section('title', '发布文章')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.min.css') }}">
@endsection

@section('header')
    <h1>
        发布文章
    </h1>
@endsection

@section('content')
        <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">

                <form role="form" method="post" action="{{ url('backend/article') }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">标题</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="title" id='title' placeholder='标题'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">文章内容</label>
                            <div id="editormd">
                                <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="markdown-content"></textarea>
                                <textarea class="editormd-html-textarea" style="display:none;"  name="html-content"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">文章分类</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <select id='cate_id' class='form-control'>
                                        <option value=''>请选择</option>
                                        <option value=''>请选择</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags">标签</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' id='tags' name="tags" placeholder='多个标签以; 分割'>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field() }}


                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">发布</button>
                        <button type="reset" class="btn btn-warning">重置</button>
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('editor.md/editormd.min.js') }}"></script>
    <script>
        $(function() {
            var editor = editormd("editormd", {
                path        : "../../editor.md/lib/",
                height  : 500,
                syncScrolling : "single",
                toolbarAutoFixed: false,
                saveHTMLToTextarea : true
            });
        });
    </script>
@endsection