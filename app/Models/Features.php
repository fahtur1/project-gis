<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Features
 *
 * @mixin Builder
 * @property int $id_feature
 * @property string $type
 * @property int $id_geometry
 * @property int $id_property
 * @method static Builder|Features newModelQuery()
 * @method static Builder|Features newQuery()
 * @method static Builder|Features query()
 * @method static Builder|Features whereIdFeature($value)
 * @method static Builder|Features whereIdGeometry($value)
 * @method static Builder|Features whereIdProperty($value)
 * @method static Builder|Features whereType($value)
 */
class Features extends Model
{
    protected $table = 'features';

    protected $primaryKey = 'id_feature';

    public $timestamps = false;

    protected $fillable = [
        'type', 'id_geometry', 'id_property'
    ];

    protected $attributes = [
        'type' => 'Feature'
    ];

    public function geometry()
    {
        return $this->belongsTo('App\Models\Geometry', 'id_geometry', 'id_geometry');
    }

    public function property()
    {
        return $this->belongsTo('App\Models\Property', 'id_property', 'id_property');
    }

    public function delete()
    {
        parent::delete();
        if (!str_contains($this->property->gambar, 'http')) {
            Storage::disk('images')->delete('places/' . $this->property->gambar);
        }

        return
            Geometry::find($this->geometry->id_geometry)->delete() &&
            Property::find($this->property->id_property)->delete();
    }


}
