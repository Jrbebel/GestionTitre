<?php

namespace coffre\DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name) {
        return array('name' => $name);
    }

    /**
     * @Route("/generationpdf",name="generationpdf")
     * @Template()
     */
    public function GenerationpdfAction() {
        $Totalticket = $this->container->get('formatecode')->CalculnbreTitreAll();
        $datesession = $this->container->get('formatecode')->sessiondate();
        $requete = $this->container->get('formatecode')->CalculdetailsTitre();

        $Totaldtr = $this->container->get('formatecode')->CalculTitreAll();
//on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $html = $this->renderView('coffreDocumentBundle:Default:document.html.twig', array('entity' => $requete, "totalticket" => $Totaldtr[1], "date" => $datesession->format("m-M-Y")));
//on appelle le service html2pdf
        $html2pdf = $this->get('html2pdf_factory')->create();
//real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');
//writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);
//Output envoit le document PDF au navigateur internet
        return new Response($html2pdf->Output('nom-du-pdf.pdf'), 200, array('Content-Type' => 'application/pdf'));

//        $html = $this->renderView('coffreDocumentBundle:Default:document.html.twig', array(
//            'entity' => $requete
//        ));
    }

    /**
     * @Route("/generationpdftitre",name="generationpdftitre")
     * @Template()
     */
    public function ImprimeTitreAction(Request $request) {

        $Totalticket = $this->container->get('formatecode')->CalculnbreTitreAll();
        // var_dump($this->calculSomme((string) 314));
        $somme = $this->calculSomme((string) 2145);
        print_r(intval (1523.06));
        $num1 = $this->calculNumtitre((string) 123456789);
        $num2 = $this->calculNumtitre((string) 123488878);
        $num3 = $this->calculNumtitre((string) 123488878);
        $num4 = $this->calculNumtitre((string) 123488878);
        $html = $this->renderView('coffreDocumentBundle:Default:documentitre.html.twig', array("totalticket" => $Totalticket[1], "Somme" => $somme, "num1" => $num1, "num2" => $num2));
//on appelle le service html2pdf
        //  $html2pdf = $this->get('html2pdf_factory')->create();
        $html2pdf = $this->get('html2pdf_factory')->create('P', 'A4', 'en', true, 'UTF-8', array(10, 15, 10, 15));
//real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');
//writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);


//Outpu//t envoit le document PDF au navigateur internet
        return new Response($html2pdf->Output('titre.pdf'), 200, array('Content-Type' => 'application/pdf'));

//        $html = $this->renderView('coffreDocumentBundle:Default:document.html.twig', array(
//            'entity' => $requete
//        ));
    }

    public function calculNumtitre($num) {

        $taille = strlen($num);
        $array = array();
        for ($i = 0; $i < $taille; $i++) {

            array_push($array, $num[$i]);
        }


        return $array;
    }

    public function calculSomme($somme) {

        $taille = strlen($somme);
        $array = array();

        for ($a = 5; $a > $taille; $a--) {

            array_push($array, 0);
        }
        for ($i = 0; $i < $taille; $i++) {

            array_push($array, $somme[$i]);
        }


        return $array;
    }

}
