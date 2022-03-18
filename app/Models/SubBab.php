<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_subbab',
        'isi_subbab',
        'bab_id'
    ];

    public function bab() {
        return $this->belongsTo('App\Models\Bab');
    }
}
