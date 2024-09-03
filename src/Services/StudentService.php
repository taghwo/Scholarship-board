<?php

namespace App\Services;

use App\Data\StudentDto;
use App\Entity\Student;
use App\Enums\Event;
use App\Events\NewStudentEvent;
use App\EventSubscriber\NewStudentSubscriber;
use App\Repository\StudentRepository;
use Symfony\Component\EventDispatcher\EventDispatcher;

class StudentService
{
    public function __construct(private readonly StudentRepository $repository)
    {
    }

    public function create(StudentDto $studentDto): Student
    {
        $student = new Student();
        $student->setName($studentDto->name);
        $student->setLevel($studentDto->level);
        $student->setEmail($studentDto->email);

        $this->repository->save($student, true);

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber(new NewStudentSubscriber());
        $dispatcher->dispatch(new NewStudentEvent($student), Event::STUDENT_CREATED->value);

        return $student;
    }
}
