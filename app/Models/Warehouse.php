<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    const IMPORT_WAREHOUSES = 1;
    const EXPORT_WAREHOUSES = 2;
    const EXPORT_SELLING = 3;

    protected $table = 'warehouses';

    protected $fillable = [
        'shop_id',
        'user_id',
        'warehouse_no',
        'name',
        'note',
        'type',
        'selling_id',
        'created_at',
        'updated_at'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(ProductWarehousing::class, 'warehouse_id', 'id');
    }

    public function selling()
    {
        return $this->belongsTo(Customer::class, 'selling_id', 'id');
    }
}
