<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Contracts\ProductContract;
use App\Http\Controllers\BaseController;
use App\Contracts\AttributeContract;
use Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Traits\UploadAble;
class ProductController extends BaseController
{
    use UploadAble;
    protected $attributeRepository;
    protected $productRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        return view('site.pages.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {
        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');
        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return $this->responseRedirectBack('Item added to cart successfully', 'success', false, false);
    }

    public function searchProduct(Request $request)
    {
        $products = Product::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('sku', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])->paginate(6);

        $attributes = $this->attributeRepository->listAttributes();
        foreach ($products as $value) {
            $product = $value;
        }
        if (count($products) > 0) {
            return view('site.pages.product', compact('product', 'attributes'));
        } else {
            return $this->responseRedirectBack('Product not deleted 😔.', 'error', true, true);
        }
    }
}