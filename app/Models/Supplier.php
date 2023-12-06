<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'shop_id', 'name', 'email', 'phone', 'created_at','updated_at'
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
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
