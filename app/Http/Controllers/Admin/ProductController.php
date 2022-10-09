<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\BrandContract;
use App\Contracts\CategoryContract;
use App\Contracts\ProductContract;
use App\Http\Requests\StoreProductFormRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Attribute;
use App\Contracts\AttributeContract;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;

class ProductController extends BaseController
{
    protected $brandRepository;

    protected $categoryRepository;

    protected $productRepository;

    protected $attributeRepository;

    public function __construct(
        BrandContract $brandRepository,
        CategoryContract $categoryRepository,
        ProductContract $productRepository,
        AttributeContract $attributeRepository
    ) {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function index()
    {
        $products = $this->productRepository->listProducts();
        $this->setPageTitle('Products', 'Products List');
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Create Product');
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->createProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product added successfully', 'success', false, false);
    }

    public function edit($id)
    {
        $product = $this->productRepository->findProductById($id);
        $brands = $this->brandRepository->listBrands('name', 'asc');
        $categories = $this->categoryRepository->listCategories('name', 'asc');

        $this->setPageTitle('Products', 'Edit Product');
        $attributes = $this->attributeRepository->listAttributes();
        // $productAttributes = ProductAttribute::all();
        $productAttributes = ProductAttribute::where('product_id', $id)->get();
        return view('admin.products.edit', compact('categories', 'brands', 'product', 'attributes', 'productAttributes'));
    }

    public function update(StoreProductFormRequest $request)
    {
        $params = $request->except('_token');

        $product = $this->productRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating product.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product updated successfully', 'success', false, false);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        $product = $this->productRepository->findProductById($id);
        $attributes = $product->attributes;
        foreach($attributes as $attribute){
            if($attribute)
            {
                return $this->responseRedirectBack('Delete the attributes before deleting the product.', 'error', true, true);
            }
        }

        $product->delete();

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting category.', 'error', true, true);
        }
        return $this->responseRedirect('admin.products.index', 'Product deleted successfully', 'success', false, false);
    }
}
