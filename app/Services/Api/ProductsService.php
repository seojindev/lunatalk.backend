<?php


namespace App\Services\Api;

use App\Exceptions\ClientErrorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductsService
{

    public function productCreate(Request $request) : void
    {
        // TODO 벨리데이션.
        $validator = Validator::make($request->all(), [
            'product_category' => 'required|exists:codes,code_id',
            'product_name' => 'required|string|min:1',
            'product_option_step1' => 'required|exists:codes,code_id',
            'product_price' => 'required|numeric|min:1',
            'product_stock' => 'required|numeric|min:1',
            'product_barcode' => 'required|string|min:1',
            'product_sale' => 'required|in:Y, N|min:1',
            'product_active' => 'required|in:Y, N|min:1',
            'product_image' => 'required|numeric|min:1',
            'product_thumbnail_image' => 'required|numeric|min:1',
            'product_detail_image' => 'required|numeric|min:1',
        ],
            [
                'title.required'=> __('default.post.title_required'),
                'tags.required'=> __('default.post.tags_required'),
                'contents.required'=> __('default.post.contents_required'),
                'contents.*.required'=> __('default.post.contents_required'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }
        return;
    }

}
