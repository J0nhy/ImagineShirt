<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class tshirt_images extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'id', 'costumer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getSlugAttribute()
    {
        if($this->name == '')
            return $this->id;

        return $this->id . '-' . Str::slug($this->name , "-");
    }
}
