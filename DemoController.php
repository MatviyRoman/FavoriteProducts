<?php
// modules/your-module/src/Controller/DemoController.php

namespace MyModule\Controller;

use Doctrine\Common\Cache\CacheProvider;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class DemoController extends FrameworkBundleAdminController
{
    private $cache;
       
    // you can use symfony DI to inject services
    public function __construct(CacheProvider $cache)
    {
        $this->cache = $cache;
    }
    
    public function demoAction()
    {
        return $this->render('@Modules/your-module/templates/admin/demo.html.twig');
    }
}

// modules/your-module/src/Controller/DemoController.php

// namespace MyModule\Controller;

// use Doctrine\Common\Cache\CacheProvider;
// use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

// class DemoController extends FrameworkBundleAdminController
// {
//     public function demoAction()
//     {
//         // you can also retrieve services directly from the container
//         $cache = $this->container->get('doctrine.cache');
        
//         return $this->render('@Modules/your-module/templates/admin/demo.html.twig');
//     }
// }


// modules/yourmodule/src/Controller/DemoController.php
// namespace YourCompany\YourModule\Controller;

// use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

// class DemoController extends FrameworkBundleAdminController
// {
//     public function demoAction()
//     {
//         $yourService = $this->get('your_company.your_module.your_service');

//         return $this->render('@Modules/yourmodule/templates/admin/demo.html.twig', [
//             'customMessage' => $yourService->getTranslatedCustomMessage(),
//         ]);
//     }
// }