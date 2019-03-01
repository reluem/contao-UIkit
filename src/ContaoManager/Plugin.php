<?php

/*
 * This file is part of contao/uikit.
 * (c) Lucas Rech
 * @license LGPL-3.0-or-later
 */

namespace Reluem\ContaoUIkitBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
    use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
    use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
    use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
    use Reluem\ContaoUIkitBundle\ContaoUIkitBundle;

    /**
     * @see https://github.com/contao/manager-plugin/blob/master/src/Bundle/BundlePluginInterface.php Code in GitHub
     */
    class Plugin implements BundlePluginInterface
    {
        public function getBundles(ParserInterface $parser)
        {
            return [
                BundleConfig::create(ContaoUIkitBundle::class)
                    ->setLoadAfter([
                        ContaoCoreBundle::class,
                        'Subcolumns',
                    ]),
            ];
        }
    }
