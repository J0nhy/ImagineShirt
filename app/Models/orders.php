<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'id', 'status', 'customer_id', 'date', 'total_price',
        'notes', 'nif', 'address', 'payment_type', 'payment_ref', 
        'receipt_url', 'created_at', 'updated_at'
    ];
}