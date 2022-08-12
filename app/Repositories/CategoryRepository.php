<?php

namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @param int $id
     * @param array $relations
     * @return Category|null
     */
    public function find( int $id, array $relations = [] ): ?Category
    {
        return Category::with( $relations )->whereId( $id )->first();
    }

    /**
     * @param array $list_id
     * @return Collection
     */
    public function searchByListId( array $list_id ): Collection
    {
        return Category::whereIn( 'id', $list_id )->get();
    }

    /**
     * @param string $field
     * @param $value
     * @param array $relations
     * @return Collection
     */
    public function search( string $field, $value, array $relations = [] ): Collection
    {
        return Category::with( $relations )->where( $field, $value )->get();
    }

    /**
     * @param CategoryDTO $dto
     * @return Category|null
     */
    public function store( CategoryDTO $dto ): ?Category
    {
        $category = new Category();
        $category->name        = $dto->name;
        $category->description = $dto->description;

        return $category->save() ? $category : null;
    }

    /**
     * @param int $id
     * @param CategoryDTO $dto
     * @return Category|null
     */
    public function update( int $id, CategoryDTO $dto ): ?Category
    {
        $category = $this->find( $id );
        if ( $category === null ) {
            return null;
        }

        return $category->update( $dto->toArray() ) ? $category : null;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete( int $id ): bool
    {
        return (bool)Category::whereId( $id )->delete();
    }
}
