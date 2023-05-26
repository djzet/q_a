<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'body',
    ];

    protected $primaryKey = 'id';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
