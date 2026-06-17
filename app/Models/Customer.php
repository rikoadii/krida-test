<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'custId';

    public $timestamps = false;

    protected $fillable = [
        'cust_nama',
        'cust_alamat',
        'cust_hp',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'custId', 'custId');
    }
}
