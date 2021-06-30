<?php


namespace App\Services\Api;


use App\Exceptions\ClientErrorException;
use App\Exceptions\ServiceErrorException;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ServiceRepository;
use App\Repositories\ProductsRepository;

/**
 * Class AdminServices
 * @package App\Services\Api
 */
class AdminServices
{
    /**
     * @var Request
     */
    protected Request $currentRequest;

    /**
     * @var AdminRepository
     */
    protected AdminRepository $adminRepository;

    /**
     * @var ProductsRepository
     */
    protected ProductsRepository $productsRepository;

    /**
     * @var ServiceRepository
     */
    protected ServiceRepository $serviceRepository;

    /**
     * AdminServices constructor.
     * @param Request $request
     * @param ServiceRepository $serviceRepository
     * @param AdminRepository $adminRepository
     * @param ProductsRepository $productsRepository
     */
    function __construct(Request $request, ServiceRepository $serviceRepository, AdminRepository $adminRepository, ProductsRepository $productsRepository)
    {
        $this->currentRequest = $request;
        $this->serviceRepository = $serviceRepository;
        $this->adminRepository = $adminRepository;
        $this->productsRepository = $productsRepository;
    }

    /**
     * @throws ClientErrorException
     */
    public function adminMainHomeValidator() : void
    {
        $validator = Validator::make($this->currentRequest->all(), [
            'edit_image' => 'required|exists:media_files,id',
            'edit_product_select' => 'required|exists:products,uuid',
            'edit_status' => 'required|in:Y,N',
        ],
            [
                'edit_image.required' => __('admin.service.edit.home-main.image-required'),
                'edit_image.exists' => __('admin.service.edit.home-main.image-exists'),
                'edit_product_select.required' => __('admin.service.edit.home-main.product-required'),
                'edit_product_select.exists' => __('admin.service.edit.home-main.product-exists'),
                'edit_status.required' => __('admin.service.edit.home-main.status-required'),
                'edit_status.in' => __('admin.service.edit.home-main.status-in'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }
    }

    /**
     * @throws ClientErrorException
     */
    public function createAdminMainHome() : void
    {
        $this->adminMainHomeValidator();

        $this->adminRepository->createHomeMain([
            'product_id' => $this->productsRepository->findProductByUUID($this->currentRequest->input('edit_product_select'))->id,
            'media_id' => $this->currentRequest->input('edit_image'),
            'status' => $this->currentRequest->input('edit_status')
        ]);

    }

    /**
     * @param Int $id
     * @throws ClientErrorException
     */
    public function updateAdminMainHome(Int $id) : void
    {
        $this->adminRepository->findHomeMain($id);
        $this->adminMainHomeValidator();

        $this->adminRepository->updateHomeMain($id, [
            'product_id' => $this->productsRepository->findProductByUUID($this->currentRequest->input('edit_product_select'))->id,
            'media_id' => $this->currentRequest->input('edit_image'),
            'status' => $this->currentRequest->input('edit_status')
        ]);
    }

    /**
     * @param Int $id
     */
    public function deleteAdminMainHome(Int $id) : void
    {
        $this->adminRepository->findHomeMain($id);

        $this->adminRepository->deleteHomeMain($id);
    }

    /**
     * @param Int $id
     * @throws ClientErrorException
     */
    public function updateStatusAdminMainHome(Int $id) : void
    {
        $this->adminRepository->findHomeMain($id);

        $validator = Validator::make($this->currentRequest->all(), [
            'edit_status' => 'required|in:Y,N',
        ],
            [
                'edit_status.required' => __('admin.service.edit.home-main.status-required'),
                'edit_status.in' => __('admin.service.edit.home-main.status-in'),
            ]);

        if( $validator->fails() ) {
            throw new ClientErrorException($validator->errors()->first());
        }

        $this->adminRepository->updateHomeMainStatus($id, $this->currentRequest->input('edit_status'));
    }
}
