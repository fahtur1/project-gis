<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Geometry
 *
 * @mixin Builder
 * @property int $id_geometry
 * @property string $type
 * @property array $coordinates
 * @method static Builder|Geometry newModelQuery()
 * @method static Builder|Geometry newQuery()
 * @method static Builder|Geometry query()
 * @method static Builder|Geometry whereCoordinates($value)
 * @method static Builder|Geometry whereIdGeometry($value)
 * @method static Builder|Geometry whereType($value)
 */
class Geometry extends Model
{
    protected $table = 'geometry';

    protected $primaryKey = 'id_geometry';

    public $timestamps = false;

    protected $casts = [
        'coordinates' => 'array'
    ];

    protected $fillable = [
        'coordinates'
    ];

    protected $attributes = [
        'type' => 'Point'
    ];

    public function features()
    {
        return $this->hasMany('App\Models\Features', 'id_features');
    }
}
