<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'priority',
        'project_id',
        'due_date',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'due_date' => 'datetime',
    ];

    /**
     * Get the project that a task belongs to
     *
     * @return BelongsTo
     * @author Nderi Kamau <nderikamau1212@gmail.com>
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user that a task belongs to
     *
     * @return HasMany
     * @author Nderi Kamau <nderikamau1212@gmail.com>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
