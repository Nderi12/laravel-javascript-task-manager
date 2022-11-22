<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id'
    ];

    /**
     * Get the user that a project belongs to
     *
     * @return BelongsTo
     * @author Nderi Kamau <nderikamau1212@gmail.com>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tasks that a project has
     *
     * @return HasMany
     * @author Nderi Kamau <nderikamau1212@gmail.com>
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
