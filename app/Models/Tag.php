<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\Tag as SpatieTag;

/**
 * Tag model.
 *
 * @property-read int $id
 * @property-read string $name
 * @property-read string $slug
 * @property-read string|null $type
 * @property-read int|null $order_column
 * @property-read bool $is_regular
 * @property-read \Illuminate\Database\Eloquent\Collection<int,Member> $members
 * @property-read \Carbon\CarbonImmutable $created_at
 * @property-read \Carbon\CarbonImmutable $updated_at
 */
final class Tag extends SpatieTag
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    /**
     * Members that have this tag.
     *
     * @return MorphToMany<Member, $this>
     */
    public function members(): MorphToMany
    {
        return $this->morphedByMany(Member::class, 'taggable', 'taggables');
    }
}
