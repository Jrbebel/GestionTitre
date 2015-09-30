<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace coffre\appBundle\FunctionService;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of Code
 *
 * @author jrbebel
 */
class Code {

    protected $request;
    protected $em;

    public function __construct(\Symfony\Component\HttpFoundation\RequestStack $request, EntityManager $em) {

        $this->request = $request;
        $this->em = $em;
    }

    public function sessiondate() {

        $session = new Session();
        $dateyears = new \DateTime('now');
        $years=$dateyears->format('Y');
        $date = new \DateTime($years.$session->get('Session'));
        return $date;
        // print_r(date($session));
    }

    public function FormateCode() {

        $code = $this->request->getCurrentRequest()->get('code');
        $array = $this->SepareCode($code);

        if ($this->doublons($array)) {
            $this->Save($array);
            return $array;
        } else {
            return false;
        }
    }

    public function SepareCode($code) {

        $code = array(
            'ntitre' => substr($code, 0, -15),
            'CleCryptage' => substr($code, 9, -13),
            'valeur' => substr($code, 11, -8),
            'emetteur' => substr($code, 16, -7),
            'cc' => substr($code, 17, -5),
            'ppp' => substr($code, 23)
        );

        return $code;
    }

    public function Save($array) {
        $session = new Session();
        $entity = new \coffre\appBundle\Entity\Ticket();
        $entity->setNumTitre($array['ntitre']);
        $entity->setCleControle($array['emetteur']);
        $entity->setCryptage($array['CleCryptage']);
        $entity->setValeur($array['valeur']);
        $entity->setType($array['ppp']);
        $entity->setOperateur($session->get('Codecaisse'));
        $entity->setSession($session->get('Session'));
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function SaveKadeos() {

        $valeur = $this->request->getCurrentRequest()->get('valeur');
        $code = array(
            'ntitre' => 11111,
            'CleCryptage' => 0,
            'valeur' => $valeur / 0.01,
            'emetteur' => 6,
            'cc' => 0,
            'ppp' => 6
        );
        $this->Save($code);
    }

    public function CalculTitre() {

        $calcul = $this->em->getRepository('coffreappBundle:Ticket')->CalculAll();
        return $calcul;
    }

    public function CalculTitreAll() {

        $calcul = $this->em->getRepository('coffreappBundle:Ticket')->CalculTitreAll();
        return $calcul;
    }

    public function CalculnbreTitreAll() {
        $calcul = $this->em->getRepository('coffreappBundle:Ticket')->CalculNbreAll();
        return $calcul;
    }

    public function CalculnbreTitre() {
        $calcul = $this->em->getRepository('coffreappBundle:Ticket')->CalculNbre();
        return $calcul;
    }

    public function CalculdetailsTitre() {
        $calcul = $this->em->getRepository('coffreappBundle:Ticket')->detailsTitre();
        return $calcul;
    }

    public function removeTitre() {

        $id = $this->request->getCurrentRequest()->get('id');
        $ticket = $this->em->getRepository('coffreappBundle:Ticket')->find($id);
        $this->em->remove($ticket);
        $this->em->flush();
    }

    public function DetailsCalculTitre() {

        $typeticket = $this->request->getCurrentRequest()->get('id');
        $ticket = $this->em->getRepository('coffreappBundle:Ticket')->deployementitre($typeticket);
        //print_r($ticket);
        return $ticket;
    }

    public function doublons($NumTitre) {

        $doublons = $this->em->getRepository('coffreappBundle:Ticket')->findBy(array('numTitre' => $NumTitre));

        if (!$doublons) {
            //  print_r("j xiste");
            return true;
        } else {
            // print_r("j existe pas");
            return false;
        }
    }

    public function OperationCaisse() {

        $caisse = $this->em->getRepository('coffreappBundle:Ticket')->OperationCaisse();
        return $caisse;
    }

    public function sumKadeosByop() {

        $caisse = $this->em->getRepository('coffreappBundle:Ticket')->sumkadeosByop();
        return $caisse;
    }

    public function sumKadeos() {

        $caisse = $this->em->getRepository('coffreappBundle:Ticket')->sumkadeos();
        return $caisse;
    }

    public function countKadeos() {

        $caisse = $this->em->getRepository('coffreappBundle:Ticket')->countkadeos();
        return $caisse;
    }

}
