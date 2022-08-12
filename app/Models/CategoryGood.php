<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CategoryGood
 *
 * @property int $good_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGood newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGood newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGood query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGood whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryGood whereGoodId($value)
 * @mixin \Eloquent
 */
class CategoryGood extends Pivot
{
    /**
     * @return BelongsTo
     */
    public function goods(): BelongsTo
    {
        return $this->belongsTo( Good::class );
    }
    /**
     * @return BelongsTo
     */
    public function categories(): BelongsTo
    {
        return $this->belongsTo( Category::class );
    }
}
