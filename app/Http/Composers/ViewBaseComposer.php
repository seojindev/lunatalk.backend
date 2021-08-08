<?php


namespace App\Http\Composers;

use Illuminate\View\View;
use App\Repositories\CodesRepository;

/**
 * Class ViewBaseComposer
 * @package App\Http\Composers
 */
class ViewBaseComposer
{
    /**
     * @var CodesRepository
     */
    protected CodesRepository $serviceRepository;

    /**
     * ViewBaseComposer constructor.
     * @param CodesRepository $serviceRepository
     */
    function __construct(CodesRepository $serviceRepository)
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
