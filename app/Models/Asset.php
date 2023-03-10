<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'asset_number',
        'code_gis',
        'quantity',
        'category_id',
        'subdivision_id',
        'group_id',
        'asset_type_id',
        'asset_name_id',
        'asset_location_id',
        'measurement_unit_id',
        'funding_source',
        'property_type',
        'year_of_possession',
        'asset_age',
        'first_location_id',
        'second_location_id',
        'subgroup_id',
    ];

    /**
     * ! Relations
     */

    /**
     * ? Category Relation
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * ? Subdivision Relation
     * @return BelongsTo
     */
    public function subdivision(): BelongsTo
    {
        return $this->belongsTo(Subdivision::class, 'subdivision_id');
    }

    /**
     * ? Group Relation
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    /**
     * ? Sub Group Relation
     * @return BelongsTo
     */
    public function subgroup(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'subgroup_id');
    }

    /**
     * ? Asset Type Relation
     * @return BelongsTo
     */
    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    /**
     * ? Asset Name Relation
     * @return BelongsTo
     */
    public function assetName(): BelongsTo
    {
        return $this->belongsTo(AssetName::class, 'asset_name_id');
    }

    /**
     * ? Asset Location Relation
     * @return BelongsTo
     */
    public function assetLocation(): BelongsTo
    {
        return $this->belongsTo(AssetLocation::class, 'asset_location_id');
    }

    /**
     * ? First Location Relation
     * @return BelongsTo
     */
    public function firstLocation(): BelongsTo
    {
        return $this->belongsTo(AssetLocation::class, 'first_location_id');
    }

    /**
     * ? Second Location Relation
     * @return BelongsTo
     */
    public function secondLocation(): BelongsTo
    {
        return $this->belongsTo(AssetLocation::class, 'second_location_id');
    }

    /**
     * ? Measurement Unit Relation
     * @return BelongsTo
     */
    public function measurementUnit(): BelongsTo
    {
        return $this->belongsTo(MeasurementUnit::class, 'measurement_unit_id');
    }
}
