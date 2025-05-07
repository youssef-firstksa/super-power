<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\CMS\NavigationService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $navigationLink = NavigationService::getCMSPageNavigationLink('products');
        $products = Product::when($request->category_id, function ($query, $value) {

            $category = Category::find($value);

            if ($category) {
                $query->whereIn('category_id', [$category->id, ...$category->children()->pluck('id')->toArray()]);
            }
        })->inRandomOrder()->paginate();
        return view('pages.cms.products.index', compact('products', 'navigationLink'));
    }

    public function show(Product $product)
    {
        return view('pages.cms.products.show', compact('product'));
    }
}
