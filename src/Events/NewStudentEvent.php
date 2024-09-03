<?php

namespace App\Events;

use App\Entity\Student;
use Symfony\Contracts\EventDispatcher\Event;

class NewStudentEvent extends Event
{
    public function __construct(public readonly Student $student)
    {
    }
}
