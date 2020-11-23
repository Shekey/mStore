<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikalImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "images";

    public function article()
    {
        return $this->belongsTo('App\Models\Articles', 'id', 'articleId');
    }

}
