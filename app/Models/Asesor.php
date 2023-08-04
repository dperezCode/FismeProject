<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;

    protected $table = 'asesores';

    protected $fillable = ['especialidad','escuela_id','user_id'];

    public function escuela(){
        return $this->belongsTo(Escuela::class);
    }
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function proyectos(){
        return $this->hasMany(Proyecto::class);
    }
}
