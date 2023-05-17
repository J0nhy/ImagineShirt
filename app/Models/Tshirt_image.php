<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tshirt_image extends Model
{
    use HasFactory;
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id', 'costumer_id', 'category_id', 'name', 'description',
        'image_url', 'extra_info', 'created_at', 'updated_at', 'deleted_at'
    ];
}
