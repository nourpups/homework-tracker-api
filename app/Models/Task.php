<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'description',
        'deadline'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
