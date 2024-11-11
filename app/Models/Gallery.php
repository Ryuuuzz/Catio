<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "Gallery";
    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public function favorites()
{
    return $this->morphMany(Favorite::class, 'favoritable');
}

}
