<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">搜索</h3>
    </div>
    <div class='panel-body'>
        <div class='row'>
            <div class='col-md-12'>
                <form action={{ route('search') }} class="form-inline" role="form">
                    <div class="input-group">
                        <input type="search" class="search-field form-control" value="" name="keyword" placeholder="请输入关键字">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>