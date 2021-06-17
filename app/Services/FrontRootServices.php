<?php


namespace App\Services;


use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

class FrontRootServices
{
    protected ServiceRepository $serviceRepository;

    function __construct( ServiceRepository $serviceRepository){
        $this->serviceRepository = $serviceRepository;
    }

    public function getCommonCode() : array
    {
        $returnObject = function($codes) {
            /**
             * 공통 코드 그룹 별로 구분.
             */
            $code_group = array();
            array_map(function($element) use (&$code_group) {

                // FIXME : 아래 경고?
                $code_group[$element['group_id']][] = [
                    'code_id' => $element['code_id'],
                    'code_name' => $element['code_name'],
                ];

            }, array_filter($codes, function($e) {
                return $e['code_id'];
            }));

            /**
             * 코드 명으로 분리.
             */
            $code_name = array();
            array_map(function($element) use (&$code_name) {
                $code_name[$element['code_id']] = $element['code_name'];
            }, array_filter($codes, function($e) {
                return $e['code_id'];
            }));

            return [
                'code_name' => $code_name,
                'code_group' => $code_group
            ];
        };

        return $returnObject($this->serviceRepository->getCommonCodeList()->toArray());
    }
}
