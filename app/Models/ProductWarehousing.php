<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarehousing extends Model
{
    use HasFactory;

    protected $table = 'product_warehousing';

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'supplier_id',
        'customer_id',
        'export_branch_id',
        'branch_id',
        'shop_id',
        'total_number',
        'price',
        'total_price',
        'note',
        'type',
        'created_at',
        'updated_at'
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function branchExport()
    {
        return $this->belongsTo(Branch::class, 'export_branch_id', 'id');
    }
}
