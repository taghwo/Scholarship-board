<?php

namespace App\Data;

use App\Entity\Student;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

//#[UniqueEntity(fields: 'email', entityClass: 'App\Entity\Student')]
class StudentDto extends BaseDto
{
    public function __construct(
        #[Assert\NotBlank]
        public ?string $name,
        #[Assert\NotBlank]
        public ?int $level,
        #[Assert\NotBlank, Assert\Email]
        public ?string $email,
        public Collection $scholarships = new ArrayCollection(),
    ) {
    }

    public static function fromModel(Student $student): self
    {
        return new self(
            name: $student->getName(),
            level: $student->getLevel(),
            email: $student->getEmail(),
            scholarships: $student->getScholarships(),
        );
    }
}
