<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Good
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property int $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Good newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Good newQuery()
 * @method static \Illuminate\Database\Query\Builder|Good onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Good query()
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Good whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Good withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Good withoutTrashed()
 * @mixin \Eloquent
 */
class Good extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'is_published',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany( Category::class )->using( CategoryGood::class );
    }
}
