<?php


namespace App\Services\Front;

use App\Repositories\ProductsRepository;
use App\Repositories\AdminRepository;
use Illuminate\Support\Carbon;

/**
 * Class AdminServices
 * @package App\Services\Front
 */
class AdminServices
{
    /**
     * @var ProductsRepository
     */
    protected ProductsRepository $productsRepository;

    /**
     * @var AdminRepository
     */
    protected AdminRepository $adminRepository;

    /**
     * AdminServices constructor.
     * @param ProductsRepository $productsRepository
     * @param AdminRepository $adminRepository
     */
    function __construct(ProductsRepository $productsRepository, AdminRepository $adminRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->adminRepository = $adminRepository;
    }

    /**
     * 심플 상품 전체 리스트.
     * @return array
     */
    public function simpleProductList() : array
    {
        return array_map(function($element) {

            $productName = $element['name'];
            $productName .= " " . $element['category']['code_name'];
            $productName .= " " . $element['options']['step1']['code_name'];
            $productName .= " " . ($element['options']['step2'] ? $element['options']['step2']['code_name'] : '');

            return [
                'id' => $element['id'],
                'uuid' => $element['uuid'],
                'productName' => trim($productName)
            ];

        } , $this->productsRepository->simpleTotalProducts()->get()->toArray());
    }

    /**
     * 홈 메인 리스트.
     * @return array
     */
    public function editMainHomeList() : array
    {
        return array_map(function($element){
            return [
                'id' => $element['id'],
                'product_id' => $element['product_id'],
                'product_name' => $element['product']['name'],
                'status' => $element['status'],
                'created_at' => Carbon::parse($element['created_at'])->format('Y년 m월 d일'),
                'updated_at' => Carbon::parse($element['updated_at'])->format('Y년 m월 d일'),
            ];

        }, $this->adminRepository->selectHomeMainStatusOrder()->get()->toArray());
    }

    /**
     * 홈 메인 편집 정보.
     * @param Int $id
     * @return array
     */
    public function updateEditMainHome(Int $id) : array
    {
        $task = $this->adminRepository->selectHomeMain($id);

        return [
            'id' => $task['id'],
            'product_id' => $task['product_id'],
            'product_uuid' => $task['product']['uuid'],
            'status' => $task['status'],
            'media_file' => [
                'media_id' => $task['media_file']['id'],
                'original_name' => $task['media_file']['original_name'],
                'url' => env('APP_MEDIA_URL') . $task['media_file']['dest_path'] . '/' . $task['media_file']['file_name'],
                'thumb_url' => env('APP_MEDIA_URL') . $task['media_file']['dest_path'] . '/' . 'thum_'.$task['media_file']['file_name'],
                'size' => $task['media_file']['file_size']
            ],
        ];
    }
}
