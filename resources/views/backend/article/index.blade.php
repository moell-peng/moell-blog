@extends('layouts.backend')

@section('title', '文章管理')

@section('header')
    <h1>
        文章管理
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-solid">
                @include('backend.alert.success')
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding ">
                    <table class="table table-hover">
                        <tr>
                            <th>序号</th>
                            <th>作者</th>
                            <th>标题</th>
                            <th>阅读数</th>
                            <th>评论数</th>
                            <th>分类</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        @if ($articles)
                            <?php $line = 1 ?>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $line }}</td>
                                    <td>
                                        {{ $author[$article->user_id] }}
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->read_count }}</td>
                                    <td>{{ $article->comment_count }}</td>
                                    <td>
                                        @if($article->cate_id > 0)
                                            {{ $category[$article->cate_id] }}
                                        @endif
                                    </td>
                                    <td>{{ $article->created_at }}</td>
                                    <td>
                                        <a href='{{ route("backend.article.edit", ["id" => $article->id]) }}' class='btn btn-info btn-xs'>
                                            <i class="fa fa-pencil"></i> 修改</a>
                                        <a data-href='{{ route("backend.article.destroy", ["id" => $article->id]) }}'
                                           class='btn btn-danger btn-xs article-delete'><i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php $line++ ?>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer clearfix">
                    {!! $articles->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(function() {
            $(".article-delete").click(function(){
                var url = $(this).attr('data-href');
                Moell.ajax.delete(url);
            });
        });
    </script>
@endsection