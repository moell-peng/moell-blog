@extends('layouts.backend')

@section('title', '文章标签')

@section('header')
    <h1>
        文章标签
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.success')
            <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-header">
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ route('backend.tag.create') }}" class="btn btn-white tooltips"
                               data-toggle="tooltip" data-original-title="新增"><i
                                        class="glyphicon glyphicon-plus"></i></a>
                        </div>
                    </div><!-- pull-right -->
                </div>
                <div class="box-body table-responsive no-padding ">
                    <table class="table table-hover">
                        <tr>
                            <th>序号</th>
                            <th>标签名</th>
                            <th>文章数</th>
                            <th>操作</th>
                        </tr>
                        @if ($tags)
                            <?php $line = 1  ?>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{ $line }}</td>
                                    <td>{{ $tag->tag_name }}</td>
                                    <td>
                                        @inject('articleTag', 'App\Presenters\ArticleTagPresenter')
                                        {{ $articleTag->getArticleNumber($tag->id) }}
                                    </td>
                                    <td>
                                        <a href='{{ route("backend.tag.edit", ["id" => $tag->id]) }}' class='btn btn-info btn-xs'>
                                            <i class="fa fa-pencil"></i> 修改</a>
                                        <a data-href='{{ route("backend.tag.destroy", ["id" => $tag->id]) }}'
                                           class='btn btn-danger btn-xs tag-delete'><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php $line++ ?>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $tags->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            $(".tag-delete").click(function(){
                var url = $(this).attr('data-href');
                Moell.ajax.delete(url);
            });
        });
    </script>
@endsection