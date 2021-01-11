<?php

namespace App\Models;

use App\Models\InvoiceMeta;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'status', 'user_id'
    ];

// RELACIONES
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment');
    }

    public function metas()
    {
        return $this->hasMany('App\Models\InvoiceMeta');
    }

// ALMACENAMIENTO
    public function store($request)
    {
        return self::create([
            'amount' => 500,
            'status' => 'pending',
            'user_id' => $request->user()->id 
        ]);
    }

// RECUPERACIÓN DE INFORMACIÓN
    public function meta($key, $default = null)
    {
        $value = $this->metas->where('key', $key)->first();
        $value = (is_null($value)) ? $default : $value->value;
        return $value;
    }

    public function concept()
    {
        return $this->meta('concept', 'Sin especificar');
    }

    public function doctor($default = 'Sin especificar')
    {
        $user_id = $this->meta('doctor', $default);
        $user = User::findOrFail($user_id);
        return $user;
    }

    public function status()
    {

    }

}
