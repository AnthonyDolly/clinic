<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value', 'invoice_id'
    ];

// RELACIONES
    public function invoice()
    {
        return $this->belongsTo('App\Models\Invoice');
    }

// ALMACENAMIENTO
}
