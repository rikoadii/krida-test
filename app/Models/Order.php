<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'orderId';

    public $timestamps = false;

    protected $fillable = [
        'orderNo',
        'orderDate',
        'custId',
        'subtotal',
        'discAmount',
        'netto',
        'dpp',
        'ppn',
        'grandtotal',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'custId', 'custId');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'orderId', 'orderId');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'orderDate' => 'date',
            'subtotal' => 'decimal:2',
            'discAmount' => 'decimal:2',
            'netto' => 'decimal:2',
            'dpp' => 'decimal:2',
            'ppn' => 'decimal:2',
            'grandtotal' => 'decimal:2',
        ];
    }
}
