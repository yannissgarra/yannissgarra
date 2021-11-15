<?php

declare(strict_types=1);

namespace App\Common\Presentation\Action;

use Webmunkeez\ADRBundle\Action\ActionInterface;
use Webmunkeez\ADRBundle\Action\ActionTrait;
use Webmunkeez\ADRBundle\Response\ResponderAwareInterface;
use Webmunkeez\ADRBundle\Response\ResponderAwareTrait;

abstract class AbstractAction implements ActionInterface, ResponderAwareInterface
{
    use ResponderAwareTrait;
    use ActionTrait;
}
