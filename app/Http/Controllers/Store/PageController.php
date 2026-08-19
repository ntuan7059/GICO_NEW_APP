<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', true)
            ->with(['translations' => function ($query) {
                $query->where('language_code', app()->getLocale());
            }])
            ->firstOrFail();

        $translation = $page->translations->first();

        return view('themes.xylo.pages.show', compact('page', 'translation'));
    }
}
