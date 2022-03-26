<?php


namespace App\Http\Composers;

use Illuminate\View\View;
use App\Http\Services\RootServices;

/**
 * Class ViewBaseComposer
 * @package App\Http\Composers
 */
class ViewBaseComposer
{
    /**
     * @var RootServices
     */
    private RootServices $apiRootServices;

    /**
     * ViewBaseComposer constructor.
     * @param RootServices $apiRootServices
     */
    function __construct(RootServices $apiRootServices)
    {
        $this->apiRootServices = $apiRootServices;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('composeCodeList', $this->apiRootServices->getCommonCodeList());
//        $view->with('commonData', []);
    }
}
