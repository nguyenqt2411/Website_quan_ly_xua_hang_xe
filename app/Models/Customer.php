<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'shop_id', 'customer_no', 'name', 'email', 'phone', 'address', 'created_at','updated_at'
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
            $params['customer_no'] = genderCode('KH', $id);
            return $this->find($id)->update($params);
        }
        $idCreate = $this->insertGetId($params);

        if ($idCreate)
        {
            $params['customer_no'] = genderCode('KH', $idCreate);
            return $this->find($idCreate)->update($params);
        }
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }
}
