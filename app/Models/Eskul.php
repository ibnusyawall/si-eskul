<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eskul extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_eskul',
        'deskrispi'
    ];

    public function babs() {
        return $this->hasMany('App\Models\Bab');
    }

    public function anggotas() {
        return $this->hasMany('App\Models\Anggota');
    }
}
