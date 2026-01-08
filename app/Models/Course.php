<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'category_id',
        'grade',
        'price',
        'is_deleted',
        'description'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_deleted' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    public function coursedetails()
    {
        return $this->hasMany(CourseDetail::class);
    }

    public function courseuser()
    {
        return $this->hasMany(CourseUser::class);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', false);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name', // Take the 'name' field and turn it into 'slug'
                'onUpdate' => true, // Update slug if name changes? (Optional)
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
