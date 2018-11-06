<div class="panel panel-default author">
    @inject('userPresenter', 'App\Presenters\UserPresenter')
    <?php
        $author = isset($user->id) ? $user : $userPresenter->getUserInfo();
    ?>
    <div class="panel-heading">
        <h3 class="panel-title">{{ $author->name }}</h3>
    </div>
    <div class="panel-body">
        <div class="row text-center">
            <img src="{{ $author->user_pic }}" class="img-circle author-avatar" alt="User Image">
        </div>
        <div class="row text-center author-footer">
            <?php
            $github_url = '';
            $weibo_url = '';
            if (!isset($user->id) || $user->id == 1) { //临时
                $github_url = $systemPresenter->getKeyValue('github_url');
                $weibo_url = $systemPresenter->getKeyValue('weibo_url');
            }
            ?>
            @if ($github_url != "")
                <span class="icon-github" style="padding-left:20px;">
                    <a href='{{ $github_url }}' target="_blank">GitHub</a>
                </span>
            @endif
            @if ($weibo_url != "")
                <span class="icon-sina-weibo" style="padding-left:20px;margin-left:10px;">
                    <a href='{{ $weibo_url }}' target="_blank">Weibo</a>
                </span>
            @endif
        </div>
    </div>
</div>