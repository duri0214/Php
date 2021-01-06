<?php

namespace App\Service;



use Doctrine\ORM\EntityManagerInterface;

class MyService
{
    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    public function getMessagesAll(){
        $query = $this->manager->createQuery(
            "SELECT m FROM App\Entity\Message m"
        );

        return $query->getResult();
    }

    public function getMessagesOver0()
    {
        $query = $this->manager->createQuery(
            "SELECT m FROM App\Entity\Message m where m.price >0"
        );

        return $query->getResult();
    }
}