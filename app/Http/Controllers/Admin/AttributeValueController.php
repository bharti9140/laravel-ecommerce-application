<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
// use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;
use App\Http\Controllers\BaseController;


class AttributeValueController extends BaseController
{
    protected $attributeRepository;

    public function __construct(AttributeContract $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    public function addValues(Request $request)
    {
        $data = $request->all();
        $attribute = AttributeValue::create($data);

        return back()->with("Added",'Attribute value save successfully.');

    }

    public function updateValues(Request $request)
    {
        $attributeValue = AttributeValue::findOrFail($request->input('valueId'));
        $attributeValue->attribute_id = $request->input('id');
        $attributeValue->value = $request->input('value');
        $attributeValue->price = $request->input('price');
        $attributeValue->save();

        return response()->json($attributeValue);
    }

    public function deleteValues($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();
        return back()->with("Delete",'Attribute value deleted successfully.');
    }
}
