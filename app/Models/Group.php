<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
        'is_subgroup',
        'subdivision_id',
        'parent_id',
    ];

    /**
     * ! Relations
     * ? With Subdivision ( One Subdivision Has Many Groups )
     * ? With Group [ Children ] ( One Groups Has Many Subgroups )
     * ? With Group [ Parent ] ( Many Subgroups Have One Groups )
     */

    /**
     * ? Subdivision Relation
     * @return BelongsTo
     */
    public function subdivision(): BelongsTo
    {
        return $this->belongsTo(Subdivision::class, 'subdivision_id');
    }

    /**
     * ? Group [ Children ] Relation
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Group::class, 'parent_id');
    }

    /**
     * ? Group [ Parent ] Relation
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }


}
