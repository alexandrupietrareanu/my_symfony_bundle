<?php

namespace KnpU\LoremIpsumBundle\Tests\Controller;

use KnpU\LoremIpsumBundle\KnpULoremIpsumBundle;
use KnpU\LoremIpsumBundle\Tests\StubWordList;
use KnpU\LoremIpsumBundle\WordProviderInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class IpsumApiControllerTest extends TestCase
{
    public function testIndex()
    {
        $kernel = new KnpULoremIpsumControllerKernel();
        $client = new KernelBrowser($kernel);
        $client->request('GET', '/api/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}
class KnpULoremIpsumControllerKernel extends Kernel
{
    use MicroKernelTrait;
    private $knpUIpsumConfig = array();

    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new KnpULoremIpsumBundle(),
            new FrameworkBundle()
        ];
    }

    public function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->import(__DIR__.'/../../src/Resources/config/routes.xml', '/api');
    }

    public function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
       $container->loadFromExtension('framework',[
           'secret' => 'F00'
       ]);

    }

    public function getCacheDir()
    {
        return __DIR__.'/cache/'.spl_object_hash($this);
    }
}