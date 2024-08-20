<?php

namespace Modules\Shop\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Modules\Shop\DTO\Request\ImportProductRequest;
use Modules\Shop\DTO\Request\SearchProductRequest;
use Modules\Shop\DTO\Request\ShopCreateProductRequest;
use Modules\Shop\DTO\Request\ShopCreateVariantRequest;
use Modules\Shop\DTO\Request\ShopUpdateProductRequest;
use Modules\Shop\DTO\Request\ShopUpdateVariantRequest;
use Modules\Shop\Enum\TypeImportProductEnum;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Request\CreateProductRequest;
use Modules\Shop\Request\ActionVariantRequest;
use Modules\Shop\Request\ImportVariantRequest;
use Modules\Shop\Request\UpdateProductRequest;
use Modules\Shop\Service\Product\CreateProductsService;
use Modules\Shop\Service\Product\CreateVariantService;
use Modules\Shop\Service\Product\DeleteProductsService;
use Modules\Shop\Service\Product\DeleteVariantService;
use Modules\Shop\Service\Product\GetProductService;
use Modules\Shop\Service\Product\GetProductsService;
use Modules\Shop\Service\Product\ImportProductVariantService;
use Modules\Shop\Service\Product\UpdateProductsService;
use Modules\Shop\Service\Product\UpdateVariantService;

class ProductControllerApi
{
    use ResponseTrait;

    /**
     * @var GetProductsService
     */
    private GetProductsService $getProductsService;
    /**
     * @var CreateProductsService
     */
    private CreateProductsService $createProductsService;
    /**
     * @var GetProductService
     */
    private GetProductService $getProductService;
    /**
     * @var CreateVariantService
     */
    private CreateVariantService $createVariantService;
    /**
     * @var UpdateVariantService
     */
    private UpdateVariantService $updateVariantService;
    /**
     * @var DeleteVariantService
     */
    private DeleteVariantService $deleteVariantService;
    /**
     * @var UpdateProductsService
     */
    private UpdateProductsService $updateProductsService;
    /**
     * @var DeleteProductsService
     */
    private DeleteProductsService $deleteProductsService;
    private ImportProductVariantService $importProductVariantService;

    /**
     * @param GetProductsService $getProductsService
     * @param CreateProductsService $createProductsService
     * @param GetProductService $getProductService
     * @param CreateVariantService $createVariantService
     * @param UpdateVariantService $updateVariantService
     * @param DeleteVariantService $deleteVariantService
     * @param UpdateProductsService $updateProductsService
     * @param DeleteProductsService $deleteProductsService
     * @param ImportProductVariantService $importProductVariantService
     */
    public function __construct(
            GetProductsService $getProductsService,
            CreateProductsService $createProductsService,
            GetProductService $getProductService,
            CreateVariantService $createVariantService,
            UpdateVariantService $updateVariantService,
            DeleteVariantService $deleteVariantService,
            UpdateProductsService $updateProductsService,
            DeleteProductsService $deleteProductsService,
            ImportProductVariantService $importProductVariantService,
    )
    {
        $this->getProductsService = $getProductsService;
        $this->createProductsService = $createProductsService;
        $this->getProductService = $getProductService;
        $this->createVariantService = $createVariantService;
        $this->updateVariantService = $updateVariantService;
        $this->deleteVariantService = $deleteVariantService;
        $this->updateProductsService = $updateProductsService;
        $this->deleteProductsService = $deleteProductsService;
        $this->importProductVariantService = $importProductVariantService;
    }

    /**
     * @throws \Exception
     */
    public function getListProduct(Request $request): JsonResponse
    {
        try {
            $searchParam = $this->extractSearchParam($request);
            $products = $this->getProductsService->handle($searchParam);
            return $this->successResponse($products);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());
        }

    }

    /**
     * @param Request $request
     * @return SearchProductRequest
     */
    public function extractSearchParam(Request $request): SearchProductRequest
    {
        return new SearchProductRequest(
            $request->get('name') ?? null,
            $request->get('category_id') ?? null,
            $request->get('page_size') ?? null,
        );
    }


    /**
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {

            $variants = json_decode($request->get('variant'), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Invalid JSON format for variant");
            }

            $path = "";
            if($request->hasFile("thumbnail")){
                $path = Storage::disk('public')->putFile("product",$request->file('thumbnail'));
            }

            $dto = new ShopCreateProductRequest(
                $request->get('name') ?? "",
                $request->get('price') ?? null,
                $request->get('sale_price') ?? null,
                $request->get('slug') ?? "",
                $path ?? "",
                $request->get('category_id') ?? null,
                $request->get('description') ?? "",
                $variants ?? []
            );
            $this->createProductsService->handle($dto);
            DB::commit();
            return $this->successResponse([]);

        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, $id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $path = "";
            if($request->hasFile("thumbnail")){
                $path = Storage::disk('public')->putFile("product",$request->file('thumbnail'));
            }
            $dto = new ShopUpdateProductRequest(
                $id,
                $request->get('name')?? "",
                $request->get('price')?? null,
                $request->get('sale_price')?? null,
                $request->get('slug') ?? "",
                $path,
                $request->get('category_id')?? null,
                $request->get('description')?? "",
            );

            $this->updateProductsService->handle($dto);
            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());

        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function delete(Request $request, $id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->deleteProductsService->handle($id);
            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getProductById(Request $request, $id) : JsonResponse
    {
        try {
            $product = $this->getProductService->handle($id);
            return $this->successResponse($product);
        }catch (Exception $e){
            return $this->errorResponse($e->getMessage());

        }
    }

    /**
     * @param ActionVariantRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function createVariant(ActionVariantRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $dto = new ShopCreateVariantRequest(
                $request->get('name')?? "",
                $request->get('price')?? null,
                $request->get('sale_price')?? null,
                $request->get('import_price')?? null,
            );
            $this->createVariantService->handle($dto, $id);
            DB::commit();

            return $this->successResponse([]);

        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param ActionVariantRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function updateVariant(ActionVariantRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $dto = new ShopUpdateVariantRequest(
                $request->get('id')?? null,
                $request->get('name')?? "",
                $request->get('price')?? null,
                $request->get('sale_price')?? null,
                $request->get('import_price')?? null,
            );
            $this->updateVariantService->handle($dto, $id);
            DB::commit();

            return $this->successResponse([]);

        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function deleteVariant(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $dto = $request->get('id');
            $this->deleteVariantService->handle($dto, $id);
            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function importProductVariant(ImportVariantRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $number = $request->get('number') ?? 0;
            $type = TypeImportProductEnum::TYPE_INCREMENT;
            if($number < 0) {
                $type = TypeImportProductEnum::TYPE_DECREMENT;
            }
            $dto = new ImportProductRequest(
                $request->get('number'),
                $request->get('product_variant_id'),
                $type
            );
            $this->importProductVariantService->handle($dto);
            DB::commit();
            return $this->successResponse([]);
        }catch (Exception $e){
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }
}
