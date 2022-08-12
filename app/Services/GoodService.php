<?php

namespace App\Services;

use App\DTO\GoodDTO;
use App\Models\Good;
use App\Repositories\GoodRepository;
use Illuminate\Database\Eloquent\Collection;

class GoodService
{
    private GoodRepository $repository;

    /**
     * GoodService constructor.
     * @param GoodRepository $repository
     */
    public function __construct(GoodRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param GoodDTO $dto
     * @return Good|null
     */
    public function create( GoodDTO $dto ): ?Good
    {
        return $this->repository->store( $dto );
    }

    /**
     * @param int $id
     * @return Good|null
     */
    public function find( int $id ): ?Good
    {
        return $this->repository->find( $id );
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
     * @param float $min
     * @param float $max
     * @param array $relations
     * @return Collection
     */
    public function searchByPrices( float $min, float $max, array $relations = [] ): Collection
    {
        return $this->repository->searchRange( 'price', $min, $max, $relations );
    }

    /**
     * @param bool $is_published
     * @param array $relations
     * @return Collection
     */
    public function searchByPublishState( bool $is_published, array $relations = [] ): Collection
    {
        return $this->repository->search( 'is_published', $is_published, $relations );
    }

    /**
     * @param bool $is_trashed
     * @param array $relations
     * @return Collection
     */
    public function searchByTrashState( bool $is_trashed, array $relations = [] ): Collection
    {
        return $this->repository->getByTrashState( $is_trashed, $relations );
    }

    /**
     * @param int $id
     * @param GoodDTO $dto
     * @return Good|null
     */
    public function update( int $id, GoodDTO $dto ): ?Good
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

    /**
     * @param Good $good
     * @param Collection $categories
     */
    public function syncCategories( Good $good, Collection $categories ): void
    {
        $good->categories()->sync( $categories->pluck( 'id' ) );
    }

    /**
     * @param int $id
     * @return Good|null
     */
    public function publish( int $id ): ?Good
    {
        $dto = new GoodDTO();
        $dto->is_published = true;

        return $this->repository->update( $id, $dto );
    }
}
