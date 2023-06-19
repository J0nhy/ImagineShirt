<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['id','name', 'deleted_at'];

    public function categorias()
    {
        return $this->hasMany(tshirt_images::class, 'categoria', 'id');
    }


    public function getSlugAttribute()
    {
        if($this->name == '')
            return $this->id;

        return $this->id . '-' . Str::slug($this->name , "-");
    }
}
