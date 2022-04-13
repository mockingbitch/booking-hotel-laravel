<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\RepositoryInterface\ServiceRepositoryInterface;
use Session;

class ServiceController extends Controller
{
    /**
     * @var @serviceRepository
     */
    private $serviceRepository;

    /**
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index() 
    {
        $services = $this->serviceRepository->getAll();
        $msg = Session::get('msg');

        return view('admin.service.service-list',[
            'services' => $services,
            'title' => 'Dashboard-service',
            'breadcrumb' => 'Service',
            'msg' => $msg
        ]);
    }
}
