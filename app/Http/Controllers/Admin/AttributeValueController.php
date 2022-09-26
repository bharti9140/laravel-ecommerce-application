<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\DB;
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
        $id = $request->value_id;
        $data = array(
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
            'price' => $request->price
        );

        DB::table('attribute_values')->updateOrInsert(['id' => $id], $data);

        return redirect()->route('admin.attributes.edit', ['attribute_id' => $request->attribute_id]);
    
    }

    public function deleteValues($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $attributeValue->delete();
        return back()->with("Delete",'Attribute value deleted successfully.');
    }
}
