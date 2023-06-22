<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class users extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','name', 'email', 'user_type', 'password', 'photo_url'];
}
