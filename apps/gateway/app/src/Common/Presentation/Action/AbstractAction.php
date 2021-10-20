<?php

declare(strict_types=1);

namespace App\Common\Presentation\Action;

use Webmunkeez\AdrBundle\Action\ActionInterface;
use Webmunkeez\AdrBundle\Action\ActionTrait;
use Webmunkeez\AdrBundle\Response\ResponderAwareInterface;
use Webmunkeez\AdrBundle\Response\ResponderAwareTrait;

abstract class AbstractAction implements ActionInterface, ResponderAwareInterface
{
    use ResponderAwareTrait;
    use ActionTrait;
}
