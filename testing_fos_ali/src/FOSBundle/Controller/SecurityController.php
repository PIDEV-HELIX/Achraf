<?php

namespace FOSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{public function  countPromo()
{
    $rest=0;
    $em = $this->getDoctrine()->getManager();
    $promo = $em->getRepository('ShopBundle:Promotion')->findAll();
    foreach ($promo as $p)
    {
        $rest= $rest+1;
    }

    return $rest;
}
    public function  countLivr()
    {
        $rest=0;
        $em = $this->getDoctrine()->getManager();
        $promo = $em->getRepository('ShopBundle:Livr')->findAll();
        foreach ($promo as $p)
        {
            $rest= $rest+1;
        }

        return $rest;
    }
    public function redirectAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@FOS/Security/admin.html.twig', array(
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,));
            else if(!($user->isSuperAdmin()))
                return $this->render('@FOS/Security/redirect.html.twig', array(
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,));
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

}
