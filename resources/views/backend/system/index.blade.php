@extends('layouts.backend')

@section('title', '博客设置')

@section('header')
    <h1>
        博客设置
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('backend.alert.warning')
            @include('backend.alert.success')
            <div class="box box-solid">
                <form role="form" method="post" enctype="multipart/form-data" action="{{ url('backend/system') }}" id="system-form" >
                    <div class="box-body">
                        <div class="form-group">
                            <label for="blog_name">博客名字</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $system['blog_name'] }}" class='form-control' name="blog_name" id='blog_name' placeholder='请输入博客名字'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motto">博客格言</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type='text' value="{{ $system['motto'] }}" class='form-control' name="motto" id='motto' placeholder='请输入博客格言'>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">标题</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['title'] }}" class='form-control' name="title" id="title" placeholder="请输入标题">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo_keyword">SEO 关键字</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['seo_keyword'] }}" class='form-control' name="seo_keyword" id="seo_keyword" placeholder="请输入SEO关键字">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo_desc">SEO 描述</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['seo_desc'] }}" class='form-control' name="seo_desc" id="seo_desc" placeholder="请输入SEO 描述">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo_desc">Github 地址</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['github_url'] }}" class='form-control' name="github_url" id="github_url" placeholder="请输入Github 地址">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seo_desc">Weibo 地址</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['weibo_url'] }}" class='form-control' name="weibo_url" id="weibo_url" placeholder="请输入Weibo 地址">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment_plugin">评论插件</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <select class='form-control' name="comment_plugin" id="comment_plugin" >
                                        <option value="">请选择</option>
                                        <option value="duoshuo" {{ $system['comment_plugin'] == 'duoshuo' ? " selected " : "" }}>多说</option>
                                        <option value="disqus" {{ $system['comment_plugin'] == 'disqus' ? " selected " : "" }}>disqus</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="disqus_short_name">disqus评论short_name</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['disqus_short_name'] }}"
                                           class='form-control'
                                           name="disqus_short_name"
                                           id="disqus_short_name"
                                           placeholder="请输入disqus评论short_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="duoshuo_short_name">多说评论short_name</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['duoshuo_short_name'] }}"
                                           class='form-control'
                                           name="duoshuo_short_name"
                                           id="duoshuo_short_name"
                                           placeholder="请输入多说评论short_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icp">ICP 备案号</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <input type="text"  value="{{ $system['icp'] }}" class='form-control' name="icp" id="icp" placeholder="请输入ICP 备案号">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="statistics_script">统计脚本</label>
                            <div class="row">
                                <div class='col-md-6'>
                                    <textarea class="form-control" name="statistics_script" rows="5" placeholder="请输入合法的javascript统计脚本">{{ $system['statistics_script'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field() }}


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