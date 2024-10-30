<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rule extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'title',
        'description',
    ];
}

