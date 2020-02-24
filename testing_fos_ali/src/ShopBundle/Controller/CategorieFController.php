<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\CategorieF;

use ShopBundle\Form\CategorieFType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CategorieFController extends Controller
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
        $cat = new CategorieF();
        $form = $this->createForm('ShopBundle\Form\CategorieFType', $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();

            return $this->redirectToRoute('cat_show', array('idf' => $cat->getIdf(),
                'countPromo' => $countPromo,
                'countLivr' => $countLivr,));
        }

        return $this->render('@Shop/CategorieF/new.html.twig', array(
            'cat' => $cat,
            'form' => $form->createView(),
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));

    }


    /**
     * Displays a form to edit an existing cat entity.
     *
     * @Route("/{idf}/edit", name="cat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, $idf)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $cat = $this->getDoctrine()->getRepository(CategorieF::class)->find($idf);
        $form = $this->createForm(CategorieFType::class, $cat);

        $form =$form->handleRequest($request);

        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            return $this->redirectToRoute('cat_index');
        }

        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieF/edit.html.twig', array('form'=>$form->createView(),
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,));
        }
    }

    public function indexAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
        $cats = $em->getRepository('ShopBundle:CategorieF')->findAll();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieF/index.html.twig', array(
                    'cats' => $cats,
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
     * Finds and displays a categorieF entity.
     *
     * @Route("/{idf}", name="cat_show")
     * @Method("GET")
     */
    public function showAction($idf)
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository('ShopBundle:CategorieF')->find($idf);
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/CategorieF/show.html.twig', array(
                    'cat' => $cat,
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,
                ));

        }



    }


    public function user_showAction($idf)
    {
        $em = $this->getDoctrine()->getManager();

        $cat = $em->getRepository('ShopBundle:CategorieF')->find($idf);
        return $this->render('@Shop/CategorieF/user_show.html.twig', array(
            'cat' => $cat,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));


    }
    public function inboxAction()
    {
        return $this->render('@Shop/CategorieF/admin_inbox.html.twig');
    }
    /**
     * Displays a form to edit an existing categorieF entity.
     *
     * @Route("/{idf}", name="cat_delete")
     * @Method({"GET"})
     */
    public  function deleteAction($idf)
    {

        $em =$this->getDoctrine()->getManager();
        $form=$em->getRepository(CategorieF::class)->find($idf);
        $em->remove($form);
        $em->flush();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->redirectToRoute('cat_index');
        }

    }
}
