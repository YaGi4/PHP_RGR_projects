<?php

namespace App\DTOs;

use App\Entity\Employee;
use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;

class EmWDto
{
    public ?int $id = null;
    public ?int $idJob = null;
    public ?int $idEmployee = null;
    public ?string $EName = null;
//    public ?string $JName = null;
    public function __construct(int $id, int $idJob, int $idEmployee, string $EName)
    {
        $this->id = $id;
        $this->idJob = $idJob;
        $this->idEmployee = $idEmployee;
        $this->EName = $EName;
//        $this->JName = $JName;
    }
    public static function createFromEntities(EntityManagerInterface $entityManager, array $EW): array
    {
        $agents = [];
        for($i = 0; $i < count($EW); $i++){
            $agents[$i] = new EmWDto(
                $EW[$i]->getId(),
                $EW[$i]->getIdJob(),
                $EW[$i]->getIdEmployee(),
                $entityManager->getRepository(Employee::class)->find($EW[$i]->getIdEmployee())->getFirstName(),
//                $entityManager->getRepository(Job::class)->find($EW[$i]->getIdJob())->getNameOfInsurance()
            );
        }
        return $agents;
    }

}