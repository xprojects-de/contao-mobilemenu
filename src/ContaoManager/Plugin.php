<?php

declare(strict_types=1);

namespace XProjects\Mobilemenu\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Config\ConfigInterface;
use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouteCollection;
use XProjects\Mobilemenu\MobilemenuBundle;

class Plugin implements BundlePluginInterface, RoutingPluginInterface
{
    /**
     * @param ParserInterface $parser
     * @return array|ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [BundleConfig::create(MobilemenuBundle::class)->setLoadAfter([ContaoCoreBundle::class])];
    }

    /**
     * @param LoaderResolverInterface $resolver
     * @param KernelInterface $kernel
     * @return RouteCollection|null
     * @throws \Exception
     */
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel): ?RouteCollection
    {
        $file = __DIR__ . '/../Resources/config/routing.yml';
        return $resolver->resolve($file)->load($file);
    }

}
