<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];
    protected $casts = [
      'start_time' => 'datetime:H:i',
      'end_time' => 'datetime:H:i'
    ];

    public function teacher()
    {
        return $this->users()->role('teacher');
    }
    public function students()
    {
        return $this->users()->role('student');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function hasUser($id)
    {
        return $this->users()
            ->where('user_id', $id)
            ->exists();
    }
}
