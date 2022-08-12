<?php

namespace App\Http\Controllers;

use App\DTO\GoodDTO;
use App\Http\Requests\GoodsGetByCategoryId;
use App\Http\Requests\GoodsGetByCategoryName;
use App\Http\Requests\GoodsGetByNameRequest;
use App\Http\Requests\GoodsGetByPrices;
use App\Http\Requests\GoodsGetByPublishState;
use App\Http\Requests\GoodsStoreRequest;
use App\Http\Requests\GoodsUpdateRequest;
use App\Services\CategoryService;
use App\Services\GoodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GoodController extends Controller
{
    private GoodService $goodService;

    private CategoryService $categoryService;

    /**
     * GoodController constructor.
     * @param GoodService $goodService
     * @param CategoryService $categoryService
     */
    public function __construct(
        GoodService $goodService,
        CategoryService $categoryService )
    {
        $this->goodService = $goodService;
        $this->categoryService = $categoryService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GoodsStoreRequest $request
     * @return Response
     */
    public function store(GoodsStoreRequest $request ): Response
    {
        $good = $this->goodService->create( GoodDTO::fromRequest( $request ) );
        if ( $good !== null ) {
            $categories = $this->categoryService->searchByListId( $request->get( 'categories' ) );
            $this->goodService->syncCategories( $good, $categories );

            return response( '', 201, [ 'Location' => '/goods/' . $good->id ] );
        }

        return response( '', 400 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GoodsUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(GoodsUpdateRequest $request, int $id ): Response
    {
        $good = $this->goodService->update( $id, GoodDTO::fromRequest( $request ) );
        if ( $good !== null ) {
            return response( '', 204 );
        }

        return response( '', 404 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy( int $id ): Response
    {
        if ( $this->goodService->delete( $id ) ) {
            return response( '', 204 );
        }

        return response( '', 404 );
    }

    /**
     * @param GoodsGetByNameRequest $request
     * @return JsonResponse
     */
    public function getByName( GoodsGetByNameRequest $request ): JsonResponse
    {
        return response()->json( $this->goodService->searchByName( $request->get( 'name' ) ) );
    }

    /**
     * @param GoodsGetByCategoryId $request
     * @return JsonResponse
     */
    public function getByCategoryId( GoodsGetByCategoryId $request ): JsonResponse
    {
        return response()->json(
            $this->categoryService->find( (int)$request->get( 'categoryId' ), [ 'goods' ] )->goods ?? [] );
    }

    /**
     * @param GoodsGetByCategoryName $request
     * @return JsonResponse
     */
    public function getByCategoryName( GoodsGetByCategoryName $request ): JsonResponse
    {
        return response()->json(
            $this->categoryService->searchByName( $request->get( 'name' ), [ 'goods' ] )
                ->pluck( 'goods' )
                ->collapse()
                ->unique( fn( $item ) => $item->id )
                ->toArray() ?? [] );
    }

    /**
     * @param GoodsGetByPrices $request
     * @return JsonResponse
     */
    public function getByPrices( GoodsGetByPrices $request ): JsonResponse
    {
        return response()->json(
            $this->goodService->searchByPrices( $request->get( 'min' ), $request->get( 'max' ) ) );
    }

    /**
     * @param GoodsGetByPublishState $request
     * @return JsonResponse
     */
    public function getByPublishState( GoodsGetByPublishState $request ): JsonResponse
    {
        return response()->json( $this->goodService->searchByPublishState( $request->get( 'isPublished' ) ) );
    }

    /**
     * @return JsonResponse
     */
    public function getNotDeleted(): JsonResponse
    {
        return response()->json( $this->goodService->searchByTrashState( false )->toArray() );
    }
}
