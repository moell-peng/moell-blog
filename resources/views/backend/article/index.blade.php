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
            @include('backend.alert.success')
            <div class="box box-solid">
                <div class="box-header">
                    <form class="form-inline" action="" method="get">
                        <div class="form-group">
                            <label for="title">标题</label>&nbsp;
                            <input name='title' type="text" class="form-control" id="title" placeholder="请输入文章标题">&nbsp;
                        </div>
                        <div class="form-group">
                            <label for="cate_id">分类</label>&nbsp;
                            @inject('categoryPresenter', 'App\Presenters\CategoryPresenter')
                            {!! $categoryPresenter->getSelect(0, '请选择', '') !!}
                        </div>
                        <button type="submit" class="btn btn-info">搜索</button>
                        <div class="pull-right">
                            <a href='{{ route("backend.article.create") }}' class='btn btn-success btn-xs'>
                                <i class="fa fa-plus"></i>发布文章</a>
                        </div>
                    </form>
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
                            @inject('articlePresenter', 'App\Presenters\ArticlePresenter')

                            <?php $line = 1 ?>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $line }}</td>
                                    <td>
                                        {{ $author[$article->user_id] }}
                                    </td>
                                    <td>{{ $articlePresenter->formatTitle($article->title) }}</td>
                                    <td>{{ $article->read_count }}</td>
                                    <td>{{ $article->comment_count }}</td>
                                    <td>
                                        {{ $category[$article->cate_id] or '分类已删除' }}
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