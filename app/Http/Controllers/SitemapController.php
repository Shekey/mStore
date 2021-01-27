<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $markets = Market::all();
        return response()->view('sitemap', compact('markets'))->header('Content-Type', 'text/xml');
    }
}
