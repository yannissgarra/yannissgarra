<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Twig;

use App\Common\Presentation\Action\ActionInterface;
use ReflectionAttribute;
use ReflectionClass;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class TemplateListener implements EventSubscriberInterface
{
    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();

        // act only on our controllers
        if (!$controller instanceof ActionInterface) {
            return;
        }

        $reflection = new ReflectionClass($controller);
        $reflectionAttributes = $reflection->getAttributes(Template::class, ReflectionAttribute::IS_INSTANCEOF);

        if (0 === count($reflectionAttributes)) {
            return;
        }

        if (count($reflectionAttributes) > 1) {
            throw new TemplateAnnotationException(/* TODO: more precise message */);
        }

        $template = $reflectionAttributes[0]->newInstance();

        $request = $event->getRequest();
        $request->attributes->set('_template_path', $template->getPath());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
