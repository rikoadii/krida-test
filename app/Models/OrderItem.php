<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $table = 'orderItem';

    protected $primaryKey = 'orderItemId';

    public $timestamps = false;

    protected $fillable = [
        'orderId',
        'itemId',
        'qty',
        'price',
        'discAmount',
        'totalItem',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderId', 'orderId');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'itemId', 'itemId');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'qty' => 'decimal:2',
            'price' => 'decimal:2',
            'discAmount' => 'decimal:2',
            'totalItem' => 'decimal:2',
        ];
    }
}
