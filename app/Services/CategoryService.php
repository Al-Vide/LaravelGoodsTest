<?php

namespace App\Services;

use App\DTO\CategoryDTO;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private CategoryRepository $repository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CategoryDTO $dto
     * @return Category|null
     */
    public function create( CategoryDTO $dto ): ?Category
    {
        return $this->repository->store( $dto );
    }

    /**
     * @param int $id
     * @param array $relations
     * @return Category|null
     */
    public function find( int $id, array $relations = [] ): ?Category
    {
        return $this->repository->find( $id, $relations );
    }

    /**
     * @param array $listId
     * @return Collection
     */
    public function searchByListId( array $listId ): Collection
    {
        return $this->repository->searchByListId( $listId );
    }

    /**
     * @param string $name
     * @param array $relations
     * @return Collection
     */
    public function searchByName( string $name, array $relations = [] ): Collection
    {
        return $this->repository->search( 'name', $name, $relations );
    }

    /**
     * @param int $id
     * @param CategoryDTO $dto
     * @return Category|null
     */
    public function update( int $id, CategoryDTO $dto ): ?Category
    {
        return $this->repository->update( $id, $dto );
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete( int $id ): bool
    {
        return $this->repository->delete( $id );
    }
}
