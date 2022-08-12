<?php

namespace App\Repositories;

use App\DTO\GoodDTO;
use App\Models\Good;
use Illuminate\Database\Eloquent\Collection;

class GoodRepository
{
    /**
     * @param int $id
     * @return Good|null
     */
    public function find( int $id ): ?Good
    {
        return Good::find( $id );
    }

    /**
     * @param string $field
     * @param $value
     * @param array $relations
     * @return Collection
     */
    public function search( string $field, $value, array $relations = [] ): Collection
    {
        return Good::with( $relations )->where( $field, $value )->get();
    }

    /**
     * @param string $field
     * @param $value_start
     * @param $value_end
     * @param array $relations
     * @return Collection
     */
    public function searchRange( string $field, $value_start, $value_end, array $relations = [] ): Collection
    {
        return Good::with( $relations )->whereBetween( $field, [ $value_start, $value_end ] )->get();
    }

    /**
     * @param bool $is_trashed
     * @param array $relations
     * @return Collection
     */
    public function getByTrashState( bool $is_trashed, array $relations = [] ): Collection
    {
        if ( $is_trashed ) {
            return Good::with( $relations )->onlyTrashed()->get();
        }

        return Good::with( $relations )->get();
    }

    /**
     * @param GoodDTO $dto
     * @return Good|null
     */
    public function store( GoodDTO $dto ): ?Good
    {
        $good = new Good();
        $good->name         = $dto->name;
        $good->description  = $dto->description;
        $good->price        = $dto->price;
        $good->is_published = $dto->is_published ?? false;

        return $good->save() ? $good : null;
    }

    /**
     * @param int $id
     * @param GoodDTO $dto
     * @return Good|null
     */
    public function update( int $id, GoodDTO $dto ): ?Good
    {
        $good = $this->find( $id );
        if ( $good === null ) {
            return null;
        }

        return $good->update( $dto->toArray() ) ? $good : null;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete( int $id ): bool
    {
        return (bool)Good::whereId( $id )->delete();
    }
}
