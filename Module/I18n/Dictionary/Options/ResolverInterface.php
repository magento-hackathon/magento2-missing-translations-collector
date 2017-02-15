<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Module\I18n\Dictionary\Options;

/**
 * Generator options resolver interface
 */
interface ResolverInterface
{
    /**
     * @return array
     */
    public function getOptions();
}
