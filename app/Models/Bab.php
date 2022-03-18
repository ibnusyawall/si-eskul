<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_bab',
        'eskul_id'
    ];

    public function eskul() {
        return $this->belongsTo('App\Models\Eskul');
    }

    public function subbabs() {
        return $this->hasMany('App\Models\SubBab');
    }
}
