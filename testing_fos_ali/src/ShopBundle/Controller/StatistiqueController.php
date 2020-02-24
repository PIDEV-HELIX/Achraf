<?php


namespace ShopBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ShopBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatistiqueController extends Controller
{

    public function  countPromo()
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
    public function StatistiqueAction()
    {$countLivr=$this->countLivr();
        $countPromo=$this->countPromo();
        $pieChart = new PieChart();
        $countPromo=$this->countPromo();
        $em= $this->getDoctrine();
        $produit = $em->getRepository('ShopBundle:Produit')->findAll();
        $totalproduit=0;
        foreach($produit as $item) {
            $totalproduit=$totalproduit+$item->getQuantite();
        }

        $data= array();
        $stat=['Produit', 'quantite'];
        $nb=0;
        array_push($data,$stat);
        foreach($produit as $item) {
            $stat=array();
            array_push($stat,$item->getNom(),(($item->getQuantite()) *100)/$totalproduit);
            $nb=($item->getQuantite() *100)/$totalproduit;
            $stat=[$item->getNom(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentage de produit Par Quantité');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('ShopBundle:Produit:index.html.twig', array(
            'piechart' => $pieChart,
            'countPromo' => $countPromo
        ));
    }
}

