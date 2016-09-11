@extends('layouts.backend')

@section('title', '文件管理')

@section('header')
    <h1>
        文件管理
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.success')
            @include('backend.alert.warning')
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-header">
                    <p>
                        <a href="{{ url('backend/file-upload') }}?dir={{ $dir }}" class="btn btn-info btn-sm">上传文件</a>
                        <buttom type="button" class="btn btn-info btn-sm" onclick="mkdir()">新建目录</buttom>
                    </p>
                </div>
                <div class="box-body table-responsive no-padding ">
                    <table class="table table-hover">
                        <tr>
                            <th>名字</th>
                            <th>类型</th>
                            <th>日期</th>
                            <th>大小</th>
                            <th>链接地址</th>
                            <th>操作</th>
                        </tr>
                        @if ($fileList)
                            @if ($fileList['dirList'])
                                @foreach($fileList['dirList'] as $dirName)
                                    <tr>
                                        <td>
                                            <?php $dirPath = "/".trim($dir."/".$dirName,'/'); ?>
                                            <a href="{{ route('backend.upload.index') }}?dir={{ $dirPath }}">
                                                {{ $dirName }}
                                            </a>
                                        </td>
                                        <td>dir</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a data-href='{{ route('backend.upload.dir-del') }}?dir={{ $dirPath }}'
                                               class='btn btn-danger btn-xs upload-delete'><i class="fa fa-trash-o"></i> 删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($fileList['fileList'])
                                @foreach($fileList['fileList'] as $file)
                                    <tr>
                                        <td>
                                            <a href="{{ $file['path'] }}" target="_blank">{{ $file['file_name'] }}</a>
                                        </td>
                                        <td>{{ $file['mime_type'] }}</td>
                                        <td>{{ $file['modified_date'] }}</td>
                                        <td>{{ $file['size'] }}</td>
                                        <td>{{ $file['path'] }}</td>
                                        <td>
                                            <a data-href='{{ route('backend.upload.file-del') }}?file={{ $dir.$file['file_name'] }}'
                                               class='btn btn-danger btn-xs upload-delete'><i class="fa fa-trash-o"></i>
                                                删除
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <div id="mkdir" style="display: none">
        <form role="form" method="post" class="form-inline"  action=""  >
            <div class="box-body">
                <div class="form-group">
                    <label for="dir_name">目录名称</label>
                    &nbsp;
                    <input name="dir" value="{{ $dir }}" type="hidden" />
                    <input type="text"  name="dir_name" id="dir_name" placeholder="目录名称">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('zclip/jquery.zclip.min.js') }}"></script>
    <script>
        $(function() {
            $(".upload-delete").click(function(){
                var url = $(this).attr('data-href');
                Moell.ajax.delete(url);
            });
        });

        function mkdir() {
            layer.open({
                type: 1,
                title: ['创建目录','padding-left:10px;font-size:16px;'],
                closeBtn: 1,
                area: '300px',
                shadeClose: true,
                skin: 'yourclass',
                id: 'mkdir-form',
                content: $("#mkdir").html(),
                btn: ['确认创建'],
                yes: function(index, layero){
                    var dirName = $("#mkdir-form input[name='dir_name']").val();
                    var dir = $("#mkdir-form input[name='dir']").val();
                    if (!dirName) {
                        layer.msg('目录名不能为空', {time: 500, icon: 5});
                    }
                    Moell.ajax.postForm("{{ route('backend.upload.mkdir') }}", {dir_name : dirName, dir:dir}, 'POST');
                }
            })
        }
    </script>
@endsection