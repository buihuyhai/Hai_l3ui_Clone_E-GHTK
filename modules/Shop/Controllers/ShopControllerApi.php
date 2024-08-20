<?php

namespace Modules\Shop\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Shop\DTO\Request\RegisterShopRequest;
use Modules\Shop\DTO\Request\UpdateShopRequest;
use Modules\Shop\Enum\StatusShopEnum;
use Modules\Shop\Helpers\ResponseTrait;
use Modules\Shop\Request\ChangeStatusRequest;
use Modules\Shop\Request\RegisterRequest;
use Modules\Shop\Request\UpdateRequest;
use Modules\Shop\Service\Shop\ChangeStatusShopService;
use Modules\Shop\Service\Shop\ConfirmShopService;
use Modules\Shop\Service\Shop\DeleteShopService;
use Modules\Shop\Service\Shop\GetShopService;
use Modules\Shop\Service\Shop\RegisterShopService;
use Modules\Shop\Service\Shop\UpdateShopService;

class ShopControllerApi
{
    use ResponseTrait;

    /**
     * @var RegisterShopService
     */
    private RegisterShopService $registerShopService;

    /**
     * @var UpdateShopService
     */
    private UpdateShopService $updateShopService;
    /**
     * @var DeleteShopService
     */
    private DeleteShopService $deleteShopService;
    /**
     * @var ConfirmShopService
     */
    private ConfirmShopService $confirmShopService;
    /**
     * @var ChangeStatusShopService
     */
    private ChangeStatusShopService $changeStatusShopService;
    /**
     * @var GetShopService
     */
    private GetShopService $getShopService;

    /**
     * @param RegisterShopService $registerShopService
     * @param UpdateShopService $updateShopService
     * @param DeleteShopService $deleteShopService
     * @param ConfirmShopService $confirmShopService
     * @param ChangeStatusShopService $changeStatusShopService
     * @param GetShopService $getShopService
     */
    public function __construct(
        RegisterShopService $registerShopService,
        UpdateShopService $updateShopService,
        DeleteShopService $deleteShopService,
        ConfirmShopService $confirmShopService,
        ChangeStatusShopService $changeStatusShopService,
        GetShopService $getShopService,
    )
    {
        $this->registerShopService = $registerShopService;
        $this->updateShopService = $updateShopService;
        $this->deleteShopService = $deleteShopService;
        $this->changeStatusShopService = $changeStatusShopService;
        $this->confirmShopService = $confirmShopService;
        $this->getShopService = $getShopService;
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function registerShop(RegisterRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $path = "";

            $validate = $request->validated();
            $dto = new RegisterShopRequest();
            $dto->setName($validate["name"] ?? "");
            $dto->setDescription($validate["description"] ?? "");
            $dto->setAddress($validate["address"] ?? "");
            $dto->setPhoneNumber($validate["phone_number"] ?? "");
            $dto->setEmail($validate["email"] ?? "");

            if($request->hasFile("logo")){
                $path = Storage::disk('public')->putFile("shop",$request->file('logo'));
            }
            $dto->setLogoUrl($path);


            $response = $this->registerShopService->handle($dto);
            DB::commit();
            return $this->successResponse($response->toArray(), "success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validate = $request->validated();
            $dto = new UpdateShopRequest();
            $dto->setName($validate["name"] ?? "");
            $dto->setDescription($validate["description"] ?? "");
            $dto->setAddress($validate["address"] ?? "");
            $dto->setPhoneNumber($validate["phone_number"] ?? "");
            $dto->setEmail($validate["email"] ?? "");

            if($request->hasFile("logo")){
                $path = Storage::disk('public')->putFile("shop",$request->file('logo'));
                $dto->setLogoUrl($path);
            }

            $this->updateShopService->handle($dto, $id);
            DB::commit();
            return $this->successResponse([], "update success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function delete(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->deleteShopService->handle($id);
            DB::commit();
            return $this->successResponse([], "delete success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function confirm(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->confirmShopService->handle($id);
            DB::commit();
            return $this->successResponse([], "confirm success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param ChangeStatusRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $status = $request->get('status') ?? StatusShopEnum::STATUS_OPEN;
            $this->changeStatusShopService->handle($id, $status);
            DB::commit();
            return $this->successResponse([], "change status success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getInfoShop(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $resource = [];
            $rs = $this->getShopService->handle($id);
            if ($rs !== null){
                $resource = $rs->toArray();
            }
            DB::commit();
            return $this->successResponse($resource, "get success");
        }catch (\Exception $e){
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

}
