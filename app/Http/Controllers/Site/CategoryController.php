<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryContract;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if(!$category){
            return redirect()->back()->with('Category not found');
        }
        return view('site.pages.category', compact('category'));
    }
}
