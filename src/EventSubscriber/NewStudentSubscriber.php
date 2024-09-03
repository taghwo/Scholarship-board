<?php

namespace App\EventSubscriber;

use App\Enums\Event;
use App\Events\NewStudentEvent;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NewStudentSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Event::STUDENT_CREATED->value => 'handle',
        ];
    }

    #[NoReturn]
    public function handle(NewStudentEvent $event): void
    {
        // Send notification to student email
        // Create activity log for student (Might use queue)
    }
}
