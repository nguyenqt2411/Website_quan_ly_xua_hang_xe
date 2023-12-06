<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'shop_id', 'trademark_id', 'category_id', 'product_no', 'product_no', 'name', 'image', 'price', 'number', 'selling', 'contents', 'created_at','updated_at'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function trademark()
    {
        return $this->belongsTo(Trademark::class, 'trademark_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'submit']);

        if ($request->images) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['image'] = $image['name'];
        }

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
