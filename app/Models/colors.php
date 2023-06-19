<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class colors extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'deleted_at'
    ];

    public function cores()
    {
        return $this->hasMany(order_items::class, 'color_code', 'code');
    }
}
