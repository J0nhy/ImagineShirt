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
    protected $primaryKey = 'id';
    protected $fillable = ['id','name', 'deleted_at'];

    public function categorias()
    {
        return $this->hasMany(tshirt_images::class, 'categoria', 'id');
    }

}
