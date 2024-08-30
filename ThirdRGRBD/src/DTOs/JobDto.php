<?php

namespace App\DTOs;

use App\Entity\TypeWorks;
use Doctrine\ORM\EntityManagerInterface;

class JobDto
{
    public ?int $id = null;
    public ?int $idTypeWork = null;
    public ?string $TypeWork = null;
    public ?int $duration = null;
    public ?string $dateBeginning = null;
    public ?string $dateEnd = null;

    public function __construct(int $id, int $idTypeWork, string $TypeWork, int $duration, string $dateBeginning, string $dateEnd)
    {
        $this->id = $id;
        $this->idTypeWork = $idTypeWork;
        $this->TypeWork =$TypeWork;
        $this->duration = $duration;
        $this->dateBeginning = $dateBeginning;
        $this->dateEnd = $dateEnd;
    }
    public static function createFromEntities(EntityManagerInterface $entityManager, array $jobs): array
    {
        $jobsDto = [];
        for($i = 0; $i < count($jobs); $i++){
            $jobsDto[$i] = new JobDto(
                $jobs[$i]->getId(),
                $jobs[$i]->getIdTypeWork(),
                $entityManager->getRepository(TypeWorks::class)->find($jobs[$i]->getIdTypeWork())->getDescription(),
                $jobs[$i]->getDuration(),
                $jobs[$i]->getDateBeginning()->format('Y-m-d H:i:s'),
                $jobs[$i]->getDateEnd()->format('Y-m-d H:i:s')
            );
        }
        return $jobsDto;
    }
}