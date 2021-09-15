<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public static $wrap = 'data';

    public function toArray($request)
    {
      return [
				'id' => $this->id,
				'first_name' => $this->first_name,
				'last_name' => $this->last_name,
				'email' => $this->email
			];
    }
}
