<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                        =>  (int) $this->id,
            'price'                     =>  getRender('clients.partials.variation-pricing', [
                'product'               =>  $this->product,
                'price'                 =>  (float) $this->price,
            ]),
            'stock'                     =>  $this->product_variation_stock ? (int) $this->product_variation_stock->stock_qty : 0,
        ];
    }
}
