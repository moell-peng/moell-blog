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
                <div class="box-header">
                    <h3 class="box-title">Responsive Hover Table</h3>

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
                            <th>分类</th>
                            <th>状态</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Moell</td>
                            <td>this is title</td>
                            <td>moell@foxmail.com</td>
                            <td>男</td>
                            <td>男</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Moell</td>
                            <td>moell@foxmail.com</td>
                            <td>男</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->

                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">&laquo;</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection