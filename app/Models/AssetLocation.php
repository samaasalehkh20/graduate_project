<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
        'location_order',
        'parent_id',
    ];

    /**
     * ! Relations
     */

    /**
     * ? AssetLocation [ Children ] Relation
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(AssetLocation::class, 'parent_id');
    }

    /**
     * ? AssetLocation [ Parent ] Relation
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(AssetLocation::class, 'parent_id');
    }

}
