<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class tshirt_images extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id', 'costumer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info', 'created_at', 'updated_at', 'deleted_at'
    ];
}
