<?php

namespace ShopBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use ShopBundle\Entity\Livr;
use ShopBundle\Form\LivrType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Livr controller.
 *
 */
class LivrController extends Controller
{ public function  countPromo()
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

    public function pdfAction() {

        $em = $this->getDoctrine()->getManager();

        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();
        $html = $this->renderView('@Shop/Livr/pdf.html.twig', array(
            'livrs'  => $livrs
        ));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'Fiche_Livraison.pdf'
        );
    }




    /**
     * Lists all livr entities.
     *
     */
    public function indexAction()
    {  $countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
       /* $livrs = $em->getRepository('ShopBundle:Livr')->editHistoryAdQB();*/
        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();

        return $this->render('@Shop/Livr/index.html.twig', array(
            'livrs' => $livrs,
            'countPromo' => $countPromo,
            'countLivr' => $countLivr,
        ));
    }


    /**
     * Lists all livr entities.
     *
     */
    public function FrontindexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();

        return $this->render('@Shop/Livr/frontindex.html.twig', array(
            'livrs' => $livrs,
        ));
    }

    /**
     * Creates a new livr entity.
     *
     */
    public function FrontnewAction(Request $request)
    {
        $livr = new Livr();
        $form = $this->createForm('ShopBundle\Form\LivrType', $livr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livr);
            $em->flush();

            return $this->redirectToRoute('livrfront_index', array('idv' => $livr->getIdv()));
        }

        return $this->render('@Shop/Livr/frontnew.html.twig', array(
            'livr' => $livr,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new livr entity.
     *
     */
    public function newAction(Request $request)
    {
        $livr = new Livr();
        $form = $this->createForm('ShopBundle\Form\LivrType', $livr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('livr_show', array('idv' => $livr->getIdv()));
        }

        return $this->render('@Shop/Livr/new.html.twig', array(
            'livr' => $livr,
            'form' => $form->createView(),
        ));
    }

    public function traiterLivrAction($idv)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rec = $entityManager->getRepository('ShopBundle:Livr')->find($idv);


        if (!$rec) {
            throw $this->createNotFoundException(
                'No product found for id ' . $idv
            );
        }
        $rec->setStatus(true);
        $entityManager->flush();
        return $this->redirectToRoute('livr_indexAdmin');

    }



    /**
     * Finds and displays a livr entity.
     *
     */
    public function showAction(Livr $livr)
    {
        $deleteForm = $this->createDeleteForm($livr);

        return $this->render('@Shop/Livr/show.html.twig', array(
            'livr' => $livr,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Finds and displays a livr entity.
     *
     */
    public function FrontshowAction(Livr $livr)
    {
        $deleteForm = $this->createDeleteForm($livr);

        return $this->render('@Shop/Livr/frontshow.html.twig', array(
            'livr' => $livr,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing livr entity.
     *
     */
    public function editAction(Request $request, $idv)
    {
        $livr = $this->getDoctrine()->getRepository(Livr::class)->find($idv);
        $form = $this->createForm(LivrType::class, $livr);

        $form =$form->handleRequest($request);

        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($livr);
            $em->flush();
            return $this->redirectToRoute('livr_index');
        }

        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/Livr/edit.html.twig', array('form'=>$form->createView()));

        }

    }

    /**
     * Displays a form to edit an existing livr entity.
     *
     */
    public function FronteditAction(Request $request, $idv)
    {
        $livr = $this->getDoctrine()->getRepository(Livr::class)->find($idv);
        $form = $this->createForm(LivrType::class, $livr);

        $form =$form->handleRequest($request);

        if($form->isSubmitted()){

            $em=$this->getDoctrine()->getManager();
            $em->persist($livr);
            $em->flush();
            return $this->redirectToRoute('livrfront_index');
        }

        $user=$this->getUser();
        if($user)
        {
            if(!$user->isSuperAdmin() )
                return $this->render('@Shop/Livr/frontedit.html.twig', array('form'=>$form->createView()));

        }

    }

  /*  public function editAction(Request $request, Livr $livr)
    {
        $deleteForm = $this->createDeleteForm($livr);
        $editForm = $this->createForm('ShopBundle\Form\LivrType', $livr);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livr_edit', array('idv' => $livr->getIdv()));
        }

        return $this->render('@Shop/Livr/edit.html.twig', array(
            'livr' => $livr,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Deletes a livr entity.
     *
     */
    public function deleteAction(Request $request, Livr $livr)
    {
        $form = $this->createDeleteForm($livr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livr);
            $em->flush();
        }

        return $this->redirectToRoute('livr_index');
    }
    /**
     * Deletes a livr entity.
     *
     */
    public function FrontdeleteAction($idv)
    {
        $sn = $this->getDoctrine()->getManager();
        $liv = $sn->getRepository('ShopBundle:Livr')->find($idv);
        $sn->remove($liv);
        $sn->flush();

        return $this->redirectToRoute('livrfront_index');
    }

    /**
     * Creates a form to delete a livr entity.
     *
     * @param Livr $livr The livr entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Livr $livr)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livr_delete', array('idv' => $livr->getIdv())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function indexLivrAdminAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
      /*  $livrs = $em->getRepository('ShopBundle:Livr')->editHistoryAdQB();*/
        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/Livr/indexLivrAdmin.html.twig', array(
                    'livrs' => $livrs,
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,
                    ));
        }
    }



    public function traiterAction($idv)
    {
        $em = $this->getDoctrine()->getManager();
        $livr = $em->getRepository('ShopBundle:Livr')->find($idv);


        if ($livr) {
        $livr = $em->getRepository('ShopBundle:Livr')->editCurrentAdQB($idv);
        $em = $this->getDoctrine()->getManager();
        $em->persist($livr);
        $em->flush();
        return $this->redirectToRoute('livr_indexAdmin');
        }

    }

    public function affectAction()
    {

        return $this->render('ShopBundle:Livr:affec.html.twig');
    }

 /*   public function traitAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $em = $this->getDoctrine()->getManager();
        $livrs = $em->getRepository('ShopBundle:Livr')->editCurrentAdQB();
        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/Livr/indexLivrAdmin.html.twig', array(
                    'livrs' => $livrs,
                    'countPromo' => $countPromo,
                    'countLivr' => $countLivr,
                ));
        }
    }*/

    public function triAction()
    {
        $em = $this->getDoctrine()->getManager();
        $livrs = $em->getRepository('ShopBundle:Livr')->findAll();
        $user=$this->getUser();
        if($user)
        {
            if($user->isSuperAdmin() )
                return $this->render('@Shop/Livr/indexLivrAdmin.html.twig', array(
                    'livrs' => $livrs,
                ));
        }
    }
}
