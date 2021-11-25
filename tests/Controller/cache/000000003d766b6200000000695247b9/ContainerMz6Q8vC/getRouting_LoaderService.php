<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'routing.loader' shared service.

$a = new \Symfony\Component\Config\Loader\LoaderResolver();

$b = new \Symfony\Component\HttpKernel\Config\FileLocator(($this->services['kernel'] ?? $this->get('kernel', 1)), (\dirname(__DIR__, 3).'/Resources'), [0 => \dirname(__DIR__, 3)], false);

$a->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($b));
$a->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($b));
$a->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($b));
$a->addLoader(new \Symfony\Component\Routing\Loader\GlobFileLoader($b));
$a->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($b));
$a->addLoader(new \Symfony\Component\Routing\Loader\ContainerLoader(new \Symfony\Bundle\FrameworkBundle\Routing\LegacyRouteLoaderContainer($this, new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'kernel' => ['services', 'kernel', 'getKernelService', false],
], [
    'kernel' => 'KnpU\\LoremIpsumBundle\\Tests\\Controller\\KnpULoremIpsumControllerKernel',
]))));

return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($a, [], ($this->privates['.legacy_controller_name_converter'] ?? ($this->privates['.legacy_controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser(($this->services['kernel'] ?? $this->get('kernel', 1)), false))));