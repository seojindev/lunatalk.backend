<?php


namespace App\Repositories;

use App\Models\Codes;

/**
 * Class ServiceRepository
 * @package App\Repositories
 */
class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var Codes
     */
    protected Codes $codes;

    /**
     * ServiceRepository constructor.
     * @param Codes $codes
     */
    public function __construct(Codes $codes)
    {
        $this->codes = $codes;
    }

    /**
     * 전체 공통으로 사용할 공통 코드.
     * @return array[]
     */
    public function getCommonCodeList() : array
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

        return $returnObject($this->codes::where('active', 'Y')->orderBy('id')->get()->toArray());
    }
}
