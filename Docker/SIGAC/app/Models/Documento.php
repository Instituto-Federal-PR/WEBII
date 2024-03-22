<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function categoria() {
        return $this->belongsTo('App\Models\Categoria');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
