<?php


namespace App\Services;


use App\Repositories\ServiceRepository;
use Illuminate\Http\Request;

/**
 * Class FrontRootServices
 * @package App\Services
 */
class FrontRootServices
{
    /**
     * @var ServiceRepository
     */
    protected ServiceRepository $serviceRepository;

    /**
     * FrontRootServices constructor.
     * @param ServiceRepository $serviceRepository
     */
    function __construct( ServiceRepository $serviceRepository){
        $this->serviceRepository = $serviceRepository;
    }
}
