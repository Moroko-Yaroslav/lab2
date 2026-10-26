<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'category_id' => $this->category_id,
            'category' => $this->category->name,
            'operation' => $this->operation,
            'price' => $this->price,
            'currency' => $this->currency,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'image' => $this->image,
            'image_url' => asset($this->image),
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'status' => $this->status,
            'published_at' => $this->published_at?->format('Y-m-d'),
            'attributes' => $this->attributes ?? [],
        ];
    }
}
