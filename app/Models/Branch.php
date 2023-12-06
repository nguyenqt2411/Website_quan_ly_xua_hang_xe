<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = [
        'shop_id', 'branch_no', 'name', 'address','created_at','updated_at'
    ];

    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'submit']);

        if ($request->shop_id) {
            $params['shop_id'] = $request->shop_id;
        } else {
            $user = Auth::user();
            $params['shop_id'] = $user->shop_id;
        }
        if ($id) {
            $params['branch_no'] = genderCode('CN', $id);
            return $this->find($id)->update($params);
        }

        $idCreate = $this->insertGetId($params);

        if ($idCreate)
        {
            $params['branch_no'] = genderCode('CN', $idCreate);
            return $this->find($idCreate)->update($params);
        }
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function imports()
    {
        return $this->hasMany(ProductWarehousing::class, 'branch_id', 'id')->where('type', Warehouse::IMPORT_WAREHOUSES);
    }

    public function exports()
    {
        return $this->hasMany(ProductWarehousing::class, 'branch_id', 'id')->whereIn('type', [Warehouse::EXPORT_WAREHOUSES, Warehouse::EXPORT_SELLING]);
    }
}
