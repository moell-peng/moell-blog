<div id="navbar" class="navbar-collapse collapse">
    @inject('navPresenter', 'App\Presenters\NavigationPresenter')
    <ul class="nav navbar-nav navbar-right">
        <?php $navigations = $navPresenter->simpleNavList(); ?>
        @if ($navigations)
            @foreach ($navigations as $navigation)
                    <li><a href="{{ $navigation->url }}" target="_blank"><span>{{ $navigation->name }}</span></a></li>
            @endforeach
        @endif
    </ul>
</div>