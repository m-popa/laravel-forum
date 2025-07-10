<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Settings\HomePageSettings;

class HomeController extends Controller
{
    public function __invoke(HomePageSettings $settings)
    {
        return view('home', [
            'categories' => Category::cachedCategories(),
            'settings'   => $settings,
        ]);
    }
}
