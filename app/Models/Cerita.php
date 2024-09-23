<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cerita extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'isi', 'foto', 'user_id'];

    //membuat relasi
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function komentars(){
        return $this->hasMany(Komentar::class);
    }
}
