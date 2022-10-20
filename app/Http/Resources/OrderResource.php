<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Resources;

use Facades\App\Http\Services\RateConverter\RateConverter;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        return [
            'order id' => $this->id,
            'item count' => $this->item_count,
            'subtotal' => $this->sub_total,
            'shipping' => $this->shipping,
            'taxes' => $this->taxes,
            'grand total USD' => $this->grand_total,
            'grand total EUR' => RateConverter::convert($this->grand_total),
            'created at' => $this->created_at
        ];
    }
}
