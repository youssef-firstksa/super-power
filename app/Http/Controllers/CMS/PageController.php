<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\NavigationLink;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug)
    {
        $navigationLink = NavigationLink::with(['children'])->where('slug', $slug)->firstOrFail();

        if ($navigationLink->children()->count() > 0) {
            return view('pages.cms.navigation-cards', [
                'page_title' => $navigationLink->label,
                'navigationLinks' => $navigationLink->children,
            ]);
        }

        if (!$navigationLink->page) {
            abort(404);
        }

        return view('pages.cms.blank', [
            'page' => $navigationLink->page,
            'navigationLink' => $navigationLink,
        ]);
    }
}
