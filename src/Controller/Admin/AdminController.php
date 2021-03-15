<?php


namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController{


    /**
     * @Route("/admin", name="admin.index")
     *
     */
    public function adminHome()
    {

       return $this->render('admin/adminHome.html.twig');
    }


}

