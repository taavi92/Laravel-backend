<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class wordBase extends Model
{
    use HasFactory;
    protected $table = 'words';
    public $fillable = [
        'word'
    ];
}
