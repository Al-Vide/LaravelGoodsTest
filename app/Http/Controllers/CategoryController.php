<?php

namespace App\Http\Controllers;

use App\DTO\CategoryDTO;
use App\Http\Requests\CategoriesStoreRequest;
use App\Services\CategoryService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoriesStoreRequest $request
     * @return Response
     */
    public function store(CategoriesStoreRequest $request ): Response
    {
        $category = $this->categoryService->create( CategoryDTO::fromRequest( $request ) );
        if ( $category !== null ) {
            return response( '', 201, [ 'Location' => '/categories/' . $category->id ] );
        }

        return response( '', 400 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy( int $id ): Response
    {
        try {
            if ( $this->categoryService->delete( $id ) ) {
                return response( '', 204 );
            }

            return response( '', 404 );
        }
        catch ( QueryException $e ) {
            if ( $e->getCode() === 23000 ) {
                return response( $e->getMessage(), 400 );
            }

            return response( '', 400 );
        }
    }
}
