@extends('layouts.backend')

@section('title', '自定义页面管理')

@section('header')
    <h1>
        自定义页面管理
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.success')
            <div class="box box-solid">
                <div class="box-header">
                    <div class="pull-right">
                        <a href='{{ route("backend.page.create") }}' class='btn btn-success btn-xs'>
                            <i class="fa fa-plus"></i>新增页面</a>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding ">
                    <table class="table table-hover">
                        <tr>
                            <th>标题</th>
                            <th>链接名</th>
                            <th>关键字</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                        @inject('pagePresenter', 'App\Presenters\PagePresenter')
                        @if($pages)
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $pagePresenter->getLink($page->id, $page->link_alias) }}</td>
                                    <td>{{ $page->keyword }}</td>
                                    <td>{{ $page->desc }}</td>
                                    <td>
                                        <a href='{{ route("backend.page.edit", ["id" => $page->id]) }}' class='btn btn-info btn-xs'>
                                            <i class="fa fa-pencil"></i> 修改</a>
                                        <a data-href='{{ route("backend.page.destroy", ["id" => $page->id]) }}'
                                           class='btn btn-danger btn-xs page-delete'><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            $(".page-delete").click(function(){
                var url = $(this).attr('data-href');
                Moell.ajax.delete(url);
            });
        });
    </script>
@endsection