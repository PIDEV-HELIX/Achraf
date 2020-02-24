<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\commandeP;
use ShopBundle\Entity\Livr;
use ShopBundle\Entity\Reclamation;
use ShopBundle\Form\LivrType;
use ShopBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
class ReclamationController extends Controller
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
    public function indexAction()
    {


        return $this->render('ShopBundle:Reclamation:index.html.twig');
    }

    public function listReclamationbackAction(Request $request)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $listrec = $this->getDoctrine()->getRepository('ShopBundle:Reclamation')->findAll();

        $rec = $this->get('knp_paginator')->paginate(
            $listrec, $request->query->get('page', 1)/*page number*/,
            4/*limit per page*/
        );
        return $this->render('ShopBundle:Reclamation:index.html.twig', array(
            'rec' => $rec,
                'countPromo' => $countPromo,
                    'countLivr' => $countLivr,
        ));
    }
    public function listReclamationAction(){
        $user=$this->getUser();
        $utilisateur=$user->getId();

        $user=$this->getUser();
        if($user)

        $rec = $this->getDoctrine()->getRepository('ShopBundle:Reclamation')->findBy(array('utilisateur'=>$utilisateur));
        return $this->render('ShopBundle:Reclamation:frontindex.html.twig', array(
            'rec' => $rec
        ));
    }
    public function listReclamationAllAction(){
        $user=$this->getUser();
        $utilisateur=$user->getId();

        $user=$this->getUser();
        if($user)

            $rec = $this->getDoctrine()->getRepository('ShopBundle:Reclamation')->findBy(array('utilisateur'=>$utilisateur));
        return $this->render('ShopBundle:Reclamation:frontindex.html.twig', array(
            'rec' => $rec
        ));
    }

  /*  public function listProduitFrontAction()
    {
        $produit = $this->getDoctrine()->getRepository('ShopBundle:Produit')->findAll();
        return $this->render('ShopBundle:Reclamation:listProduitFront.html.twig', array(
            'produit' => $produit
        ));

    }*/

    public function traiterReclamationAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rec = $entityManager->getRepository('ShopBundle:Reclamation')->find($id);


        if (!$rec) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }
        $rec->setEtat(true);
        $entityManager->flush();
        return $this->redirectToRoute('rec_index');

    }

    public function showReclamationbackAction($id)
    {
        $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $entityManager = $this->getDoctrine()->getManager();
        $rec = $entityManager->getRepository('ShopBundle:Reclamation')->find($id);
        return $this->render('ShopBundle:Reclamation:show.html.twig', array(
            'rec' => $rec,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }

    public function createReclamationFrontAction(Request $request)
    {
            $reclamation = new Reclamation();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $form = $this->createForm('ShopBundle\Form\ReclamationType', $reclamation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $reclamation->setEtat('0');
                $reclamation->setUtilisateur($user);
                $em->persist($reclamation);
                $em->flush();

                return $this->redirectToRoute('recfront_index', array('id' => $reclamation->getId()));
            }

            return $this->render('@Shop/Reclamation/frontnew.html.twig', array(
                'reclamation' => $reclamation,
                'form' => $form->createView(),
            ));
    }

    public function deleteReclamationAction($id)
    {

        $sn = $this->getDoctrine()->getManager();
        $rec = $sn->getRepository('ShopBundle:Reclamation')->find($id);
        $sn->remove($rec);
        $sn->flush();

        return $this->redirectToRoute('rec_index');
    }




    public function deleteReclamationbackAction($id)
    {

        $sn = $this->getDoctrine()->getManager();
        $rec = $sn->getRepository('ShopBundle:Reclamation')->find($id);
        $sn->remove($rec);
        $sn->flush();

        return $this->redirectToRoute('recfront_index');
    }


    public function fronteditAction(Request $request, $id)
    {
        $rec = $this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $rec);

        $form =$form->handleRequest($request);

        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('recfront_index');
        }


                return $this->render('@Shop/Reclamation/frontedit.html.twig', array('form'=>$form->createView()));


    }
    /**
     * Creates a form to delete a Reclamation entity.
     *
     * @param Reclamation $Reclamation The Reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $Reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recfront_delete', array('id' => $Reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}