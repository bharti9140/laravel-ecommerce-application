<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;

class ProductAttributeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAttribute(Request $request)
    {
        $data = $request->all();
        $att = AttributeValue::where('id', $request->attribute_value)->first();
        $id = $att->attribute_id;
        $value = isset($att['value']) ? $att['value'] : "";
        $productAttribute = ProductAttribute::create([
            'attribute_id' => $id,
            'price' => $request->price,
            'quantity' => $request->pro_quantity,
            'value' =>  $value,
            'product_id' => $request->pro_id,
        ]);

        if ($productAttribute) {
            return back()->withInput(['tab'=>'attributes'])->with("success", 'Product attribute value Added successfully.');
        } else {
            return response()->json(['message' => 'Something went wrong while submitting product attribute.']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAttribute($id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->delete();

        return back()->withInput(['tab'=>'attributes'])->with("success", 'Product attribute value deleted successfully.');
    }
}
