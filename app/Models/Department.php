<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'creator_id'];

    protected static function booted()
    {
        static::creating(function ($department) {
            $department->creator_id = auth()->id();
        });
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
