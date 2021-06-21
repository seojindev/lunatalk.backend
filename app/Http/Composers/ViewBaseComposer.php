<?php


namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\ServiceRepository;

/**
 * Class ViewBaseComposer
 * @package App\Http\Composers
 */
class ViewBaseComposer
{
    /**
     * @var ServiceRepository
     */
    protected ServiceRepository $serviceRepository;

    /**
     * ViewBaseComposer constructor.
     * @param ServiceRepository $serviceRepository
     */
    function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('composeCodeList', $this->serviceRepository->getCommonCodeList());
//        $view->with('commonData', []);
    }
}
