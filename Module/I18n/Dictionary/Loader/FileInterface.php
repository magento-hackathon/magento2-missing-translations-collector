<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Module\I18n\Dictionary\Loader;

/**
 * Dictionary loader interface
 */
interface FileInterface
{
    /**
     * Load dictionary
     *
     * @param string $file
     * @return \Hackathon\TranslationCollector\Module\I18n\Dictionary
     * @throws \InvalidArgumentException
     */
    public function load($file);
}
