@extends('layouts.backend')

@section('title', '新建页面')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('editor.md/css/editormd.min.css') }}">
@endsection

@section('header')
    <h1>
        新建页面
    </h1>
@endsection

@section('content')
        <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            @include('backend.alert.warning')
            <div class="box box-solid">
                <form role="form" method="post" action="{{ url('backend/page') }}" id="page-form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">页面标题</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="title" id='title' placeholder='标题'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link_alias">链接别名</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="link_alias" id='link_alias' placeholder='链接别名,关于页面请用about关联'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keyword">关键字(Keywords)</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' class='form-control' name="keyword" id='keyword' placeholder='请输入关键字，以英文逗号分割，利于搜索引擎收录'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc">描述(Description)</label>
                            <div class="row">
                                <div class='col-md-10'>
                                    <input type='text' class='form-control' name="desc" id='desc' placeholder='请输入页面描述'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">页面内容</label>
                            <div id="editormd">
                                <textarea class="editormd-markdown-textarea" style="display:none;" id="content" name="content"></textarea>
                                <textarea style="display:none;"  name="html_content"></textarea>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field() }}


                    <div class="box-footer">
                        <button type="submit" id="submit-page" class="btn btn-primary">创建</button>
                        <button type="button" id="reset-btn" class="btn btn-warning">重置</button>
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

        var editor = editormd("editormd", {
            path        : "{{ asset('/editor.md/lib/') }}/",
            height  : 500,
            syncScrolling : "single",
            toolbarAutoFixed: false,
            saveHTMLToTextarea : false
        });

        /* 页面操作验证 */
        $("#page-form").bootstrapValidator({
            live: 'disables',
            message: "This Values is not valid",
            feedbackIcons: {
                valid: 'glyphicon ',
                invalid: 'glyphicon ',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields : {
                title : {
                    validators : {
                        notEmpty : {
                            message : "页面标题不能为空"
                        }
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            var html = editor.getPreviewedHTML();
            $("#page-form textarea[name='html_content']").val(html);
        });
    </script>
@endsection