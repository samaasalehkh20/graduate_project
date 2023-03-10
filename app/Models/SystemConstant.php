<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SystemConstant extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_cd',
        'sub_cd',
        'name_ar',
        'name_en',
        'status',
        'parent_id'
    ];

    /**
     * ! Relations
     * ? With System Constant [ Children ] ( One SystemConstant Has Many Sub SystemConstant )
     * ? With System Constant [ Parent ] ( Many Sub SystemConstant Have One SystemConstant )
     */

    /**
     * ? System Constant [ Children ] Relation
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(SystemConstant::class, 'parent_id');
    }

    /**
     * ?  System Constant [ Parent ] Relation
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SystemConstant::class, 'parent_id');
    }

}
