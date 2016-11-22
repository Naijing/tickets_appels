<?php

namespace TicketsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use TicketsBundle\Entity\Filecsv;
use TicketsBundle\Entity\Ticket;

class TicketsController extends Controller
{
    public function addAction(Request $request)
    {
        $title='Ajouter des données (import CSV)';

        $filecsv= new Filecsv();
        $form= $this->createFormBuilder($filecsv)
            ->add('csvFile', FileType::class , array('label' => 'CSV File'))
            ->add('submit', SubmitType::class, array('label' =>'Envoyer'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid())
        {
            $file = $filecsv->getCsvFile();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $csvDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/csv';
            $f=$file->move($csvDir, $fileName);
            $filecsv->setCsvFile($fileName);

            /*$spl_object = new \SplFileObject($f, 'rb');
            $spl_object->seek(filesize($f));
            var_dump($spl_object->key() );
            */
            $pdo = $this->container->get('db1')->getPDO();

            $start = 0;
            $data = array();
            $spl_object = new \SplFileObject($f, 'rb');
            $spl_object->seek($start);
            while (!$spl_object->eof()) {
                $rang= $spl_object->fgetcsv();
                $str=explode(';',$rang[0]);
                $data[]=$str;
                $spl_object->next();

            }

            //var_dump($data);

            foreach(array_chunk($data, 1000) as $values){

                $params = array();
                $query = "INSERT INTO ticket (compteFacture,numFacture,numAbonne,date,heure,dureeReel,dureeFacture,type) VALUES ";


                //var_dump($values);
                foreach ($values as $row) {
                    $query .= "(?,?,?,?,?,?,?,?),";
                    /*foreach ($row as $value) {
                        $params[] = $value;
                    }*/

                    $params[]=$row[0];
                    $params[]=$row[1];
                    $params[]=$row[2];
                    $dates = explode("/", $row[3]);
                    $params[]=$dates[2].'-'.$dates[1].'-'.$dates[0];
                    $params[]=$row[4];
                    $params[]=$row[5];
                    $params[]=$row[6];
                    $params[]=$row[7];

                }
                $query = substr($query, 0, -1);
                $stmt = $pdo->prepare($query);
                if (!$stmt) {
                    echo "\nPDO::errorInfo():\n";
                    print_r($pdo->errorInfo());
                }
                $stmt->execute($params);

            }

            return $this->redirectToRoute('show');

        }


        return $this->render('TicketsBundle:Tickets:add.html.twig', array(
            'form' => $form->createView(),'title'=>$title
        ));
    }

    public function queryAction()
    {
        $title="Retrouver la durée totale réelle des appels effectués après le 15/02/2012 (inclus)";
        $pdo = $this->container->get('db1')->getPDO();
        $query = "SELECT dureeReel FROM ticket WHERE date >= '2012-02-15' AND type LIKE '%appel%'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $tickets=$stmt->fetchAll();
        //var_dump($tickets);
        $sum=0;
        foreach($tickets as $t){

            $parsed = date_parse($t['dureeReel']);
            $seconds = $parsed['hour'] * 3600 +$parsed['minute'] * 60+ $parsed['second'];
            $sum=$sum+$seconds;
        }

        $res=gmdate('H:i:s', $sum);
        return $this->render('TicketsBundle:Tickets:query.html.twig', array(
            'title'=>$title, 'res'=>$res
        ));
    }

    public function query3Action()
    {
        $title="Retrouver la quantité totale de SMS envoyés par l'ensemble des abonnés";
        $pdo = $this->container->get('db1')->getPDO();
        $query = "SELECT COUNT(*)  FROM ticket WHERE type LIKE '%sms%'";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $tickets=$stmt->fetch();

        return $this->render('TicketsBundle:Tickets:query3.html.twig', array(
            'title'=>$title, 'res'=>$tickets[0]
        ));
    }

    public function query2Action()
    {
        $title="le TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-
18h00, par abonné";
        $pdo = $this->container->get('db1')->getPDO();
        $query = "select * from (select * from (select * from ticket where heure NOT BETWEEN '08:00:00' AND '18:00:00' ) as c order by dureeFacture desc) as b group by numAbonne LIMIT 0, 10";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $tickets=$stmt->fetchAll();
        //var_dump($tickets);
        return $this->render('TicketsBundle:Tickets:query2.html.twig', array(
            'title'=>$title, 'res'=>$tickets
        ));
    }

    public function showAction()
    {
        $title="La base de données";
        $pdo = $this->container->get('db1')->getPDO();
        $query = "SELECT * FROM ticket ORDER BY id DESC LIMIT 0, 10";
        $stmt=$pdo->prepare($query);
        $stmt->execute();
        $tickets=$stmt->fetchAll();
        //var_dump($tickets);
        return $this->render('TicketsBundle:Tickets:show.html.twig', array(
            'title'=>$title, 'tickets'=>$tickets
        ));
    }

    public function show2Action($id)
    {
        $title="La base de données";
        $pdo = $this->container->get('db1')->getPDO();
        $query = "SELECT * FROM ticket ORDER BY id DESC LIMIT :first, :seconde";
        $stmt=$pdo->prepare($query);
        $stmt->bindValue(':first', intval(($id-1)*10), \PDO::PARAM_INT);
        $stmt->bindValue(':seconde', intval(10), \PDO::PARAM_INT);
        $stmt->execute();

        $tickets=$stmt->fetchAll();

        //var_dump($tickets);
        return $this->render('TicketsBundle:Tickets:show2.html.twig', array(
            'title'=>$title, 'tickets'=>$tickets
        ));
    }
}
