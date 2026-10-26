<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    public const OPERATIONS = [
        'Оренда',
        'Продаж',
    ];

    protected $fillable = [
        'slug',
        'title',
        'category_id',
        'operation',
        'price',
        'currency',
        'short_description',
        'description',
        'image',
        'contact_name',
        'contact_phone',
        'contact_email',
        'status',
        'published_at',
        'attributes',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'published_at' => 'date',
            'attributes' => 'array',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
