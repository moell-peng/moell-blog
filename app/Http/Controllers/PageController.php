<?php

namespace App\Http\Controllers;


use App\Models\Page;

class PageController extends Controller
{
    /**
     * @param $alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($alias)
    {
        $page  = Page::where('link_alias', $alias)->first();

        if (!$page) {
            abort('404');
        }

        return view('default.show_page', compact('page'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return $this->index('about');
    }
}
