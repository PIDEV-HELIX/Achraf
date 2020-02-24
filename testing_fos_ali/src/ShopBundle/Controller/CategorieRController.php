<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\CategorieR;

use ShopBundle\Form\CategorieRType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CategorieRController extends Controller
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
    public function newAction(Request $request)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $catr = new CategorieR();
        $form = $this->createForm('ShopBundle\Form\CategorieRType', $catr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($catr);
            $em->flush();

            return $this->redirectToRoute('catr_show', array('idc' => $catr->getIdc(),
                'countPromo' => $countPromo,
                'countLivr' => $countLivr,));
        }

        return $this->render('@Shop/CategorieR/new.html.twig', array(
            'catr' => $catr,
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));

    }


    /**
     * Displays a form to edit an existing catr entity.
     *
     * @Route("/{idc}/edit", name="catr_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $idc)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $catr = $this->getDoctrine()->getRepository(CategorieR::class)->find($idc);
        $form = $this->createForm(CategorieRType::class, $catr);

        $form =$form->handleRequest($request);

        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($catr);
            $em->flush();
            return $this->redirectToRoute('catr_index');
        }

        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieR/edit.html.twig', array('form'=>$form->createView(),
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,));
        }
    }

    public function indexAction()
    {   $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
        $catrs = $em->getRepository('ShopBundle:CategorieR')->findAll();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieR/index.html.twig', array(
                    'catrs' => $catrs,
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,

                ));

        }


    }


    /*public function user_indexAction(){
        $em = $this->getDoctrine()->getManager();

        $socs = $em->getRepository('ShopBundle:Soc')->findAll();

        return $this->render('@Shop/Soc/user_index.html.twig', array(
            'socs' => $socs,
        ));
    }*/
    /**
     * Finds and displays a categorieR entity.
     *
     * @Route("/{idc}", name="catr_show")
     * @Method("GET")
     */
    public function showAction($idc)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $catr = $em->getRepository('ShopBundle:CategorieR')->find($idc);
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieR/show.html.twig', array(
                    'catr' => $catr,
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,
                ));

        }



    }


    public function user_showAction($idc)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $catr = $em->getRepository('ShopBundle:CategorieR')->find($idc);
        return $this->render('@Shop/CategorieR/user_show.html.twig', array(
            'catr' => $catr,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,

        ));


    }
    public function inboxAction()
    {
        return $this->render('@Shop/CategorieR/admin_inbox.html.twig');
    }
    /**
     * Displays a form to edit an existing categorieR entity.
     *
     * @Route("/{idc}", name="catr_delete")
     * @Method({"GET"})
     */
    public  function deleteAction($idc)
    {

        $em =$this->getDoctrine()->getManager();
        $form=$em->getRepository(CategorieR::class)->find($idc);
        $em->remove($form);
        $em->flush();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->redirectToRoute('catr_index');
        }

    }
}
