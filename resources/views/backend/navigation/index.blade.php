@extends('layouts.backend')

@section('title', '导航管理')

@section('header')
    <h1>
        导航管理
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            @include('backend.alert.success')
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-header">
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ route('backend.navigation.create') }}" class="btn btn-white tooltips"
                               data-toggle="tooltip" data-original-title="新增"><i
                                        class="glyphicon glyphicon-plus"></i></a>
                        </div>
                    </div><!-- pull-right -->
                </div>
                <div class="box-body table-responsive no-padding ">
                    <table class="table table-hover">
                        <tr>
                            <th>序号</th>
                            <th>导航名</th>
                            <th>URL</th>
                            <th>类型</th>
                            <th>顺序</th>
                            <th>状态</th>
                            <th>文章分类</th>
                            <th>操作</th>
                        </tr>
                        @if ($navigations)
                            @inject('articleCategory', 'App\Presenters\CategoryPresenter')
                            <?php $line = 1  ?>
                            @foreach($navigations as $navigation)
                                <tr>
                                    <td>{{ $line }}</td>
                                    <td>{{ $navigation->name }}</td>
                                    <td>{{ $navigation->url }}</td>
                                    <td>
                                        @if ($navigation->nav_type == 1)
                                            文章分类
                                            @else
                                            自定义
                                        @endif
                                    </td>
                                    <td>{{ $navigation->sequence }}</td>
                                    <td>
                                        @if ($navigation->state == 1)
                                            隐藏
                                            @else
                                            显示
                                        @endif
                                    </td>
                                    <td>
                                        @if ($navigation->article_cate_id > 0)
                                            {{ $articleCategory->getIdName($navigation->article_cate_id) }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href='{{ route("backend.navigation.edit", ["id" => $navigation->id]) }}' class='btn btn-info btn-xs'>
                                            <i class="fa fa-pencil"></i> 修改</a>
                                        <a data-href='{{ route("backend.navigation.destroy", ["id" => $navigation->id]) }}'
                                           class='btn btn-danger btn-xs navigation-delete'><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php $line++ ?>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            $(".navigation-delete").click(function(){
                var url = $(this).attr('data-href');
                Moell.ajax.delete(url);
            });
        });
    </script>
@endsection