<?php

namespace Overblog\GraphiQLBundle;

use Overblog\GraphiQLBundle\DependencyInjection\OverblogGraphiQLExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OverblogGraphiQLBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (!$this->extension instanceof ExtensionInterface) {
            $this->extension = new OverblogGraphiQLExtension();
        }

        return $this->extension;
    }
}
