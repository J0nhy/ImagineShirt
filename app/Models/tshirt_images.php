<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\order_items;


class tshirt_images extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;
    protected $fillable = [
        'id', 'customer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getSlugAttribute()
    {
        if($this->name == '')
            return $this->id;

        return $this->id . '-' . Str::slug($this->name , "-");
    }

}
