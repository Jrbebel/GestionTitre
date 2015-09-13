<?php

namespace coffre\appBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller {

    /**
     * @Route("/",name="index")
     * @Template()
     */
    public function indexAction() {

        return array();
    }

    /**
     * @Route("/session",name="session")
     * @Template()
     * 
     */
    public function SessionAction(Request $request) {

        /*         * Creer une session* */
        $session = new Session();
        $session->start();
        $session->set('Session', $request->get('session') . date('m'));


        return $this->redirect($this->generateUrl("index"));
    }

    /**
     * @Route("/codecaisse",name="codecaisse")
     * @Template()
     * 
     */
    public function CodecaisseAction(Request $request) {

        /*         * Creer une session* */
        $session = new Session();
        $session->start();
        $session->set('Codecaisse', $request->get('codecaisse'));


        return $this->redirect($this->generateUrl("index"));
    }

    /**
     * @Route("/ajax/tableau",name="ajaxtab")
     * @Template("coffreappBundle:Default:tableau.html.twig")
     */
    public function TableauAction() {
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('coffreappBundle:Ticket')->findBy(array('operateur' => $session->get('Codecaisse'), 'session' => $session->get('Session')), array('id' => "desc"));

        return array('entity' => $entities);
    }

    /**
     * @Route("/code",name="recherchecode")
     * 
     * 
     */
    public function RechercheCode(Request $request) {


        if ($request->isXMLHttpRequest()) {
            $code = $request->get('code');
            $codeInfo = $this->container->get('formatecode')->FormateCode($code);
            if ($codeInfo) {

                return new Response(200); // Code 200  == ok,, make sure it has the correct content t
            } else {
                return new Response(201); //Code 201 == doublons
            }
        } else {
            return new Response(400);
        }
    }

    /**
     * @Route("/calcul",name="calculator")
     * @Template("coffreappBundle:Default:calcul.html.twig")
     */
    public function CalculAction() {

        $calcultotal = $this->container->get('formatecode')->CalculTitre();
        $calculnbretotal = $this->container->get('formatecode')->CalculnbreTitre();

        return array('calcultotal' => $calcultotal[1], 'calculnbretotal' => $calculnbretotal[1]);
    }

    /**
     * @Route("/calculdetails",name="calculdetails")
     * @Template("coffreappBundle:Default:calculdetails.html.twig")
     */
    public function DetailstitreAction() {
        $calculdetailstotal = $this->container->get('formatecode')->CalculdetailsTitre();

        return array('calculdetailstotal' => $calculdetailstotal);
    }

    /**
     * @Route("/deletetitre",name="deletetitre")
     * @Template("coffreappBundle:Default:index.html.twig")
     */
    public function DeleteTitreAction(Request $request) {

        $this->container->get('formatecode')->removeTitre();

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/detailscalultitre",name="detailscalultitre")
     * @Template("coffreappBundle:Default:detailscalultitire.html.twig")
     */
    public function DetailsCallcultitreAction(Request $request) {

        $details = $this->container->get('formatecode')->DetailsCalculTitre();
        return array('details' => $details);
        //return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/recapitulatif",name="recapitulatif")
     * @Template("coffreappBundle:Default:recapitulatif.html.twig")
     */
    public function RecapitulatifAction() {
        $Totaldtr = $this->container->get('formatecode')->CalculTitreAll();
        $sum = $this->container->get('formatecode')->sumKadeos();
        $Totalticket = $this->container->get('formatecode')->CalculnbreTitreAll();

        return array("Totaldtr" => $Totaldtr[1], "totalticket" => $Totalticket[1], "sum" => $sum[1]);
    }

    /**
     * @Route("/recapitulatifoperateur",name="recapitulatifoperateur")
     * @Template("coffreappBundle:Default:recapitulatifoperateur.html.twig")
     */
    public function RecapitulatifoperateurAction() {
        $Caisse = $this->container->get('formatecode')->OperationCaisse();
        return array("Caisse" => $Caisse);
    }

    /**
     * @Route("/calculkadeos",name="calculkadeos")
     * @Template("coffreappBundle:Default:ticketkados.html.twig")
     */
    public function CalculKadeosAction(Request $request) {

        if ($request->getMethod() == 'POST') {
            $this->container->get('formatecode')->SaveKadeos();
            return $this->redirect($this->generateUrl('index'));
        }

        return array();
    }

    /**
     * @Route("/sumkadeos",name="sumkadeos")
     * @Template("coffreappBundle:Default:ticketkados.html.twig")
     */
    public function sumkadeosAction() {
        $sum = $this->container->get('formatecode')->sumKadeos();
        $count = $this->container->get('formatecode')->countkadeos();

        return array("sum" => $sum[1], 'count' => $count[1]);
    }

}
