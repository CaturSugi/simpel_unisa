<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trash extends Model

{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'trashes';

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'weight',
        'collection_date',
        'building_id',
        'create_by',
        'update_by',
    ];

    protected $casts = [
        'collection_date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}

