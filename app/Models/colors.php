<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class colors extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'deleted_at'
    ];
}
