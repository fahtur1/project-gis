<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Property
 *
 * @mixin Builder
 * @property int $id_property
 * @property string $nama_toko
 * @property string $latitude
 * @property string $longitude
 * @property string $status_resmi
 * @property string $alamat
 * @property string $gambar
 * @method static Builder|Property newModelQuery()
 * @method static Builder|Property newQuery()
 * @method static Builder|Property query()
 * @method static Builder|Property whereAlamat($value)
 * @method static Builder|Property whereGambar($value)
 * @method static Builder|Property whereIdProperty($value)
 * @method static Builder|Property whereLatitude($value)
 * @method static Builder|Property whereLongitude($value)
 * @method static Builder|Property whereNamaToko($value)
 * @method static Builder|Property whereStatusResmi($value)
 */
class Property extends Model
{
    protected $table = 'property';

    protected $primaryKey = 'id_property';

    public $timestamps = false;

    protected $fillable = [
        'nama_toko', 'latitude', 'longitude', 'status_resmi', 'alamat', 'gambar'
    ];

    protected $attributes = [
        'gambar' => 'default.jpg'
    ];

    public function features()
    {
        return $this->hasMany('App\Models\Features');
    }
}
