<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Module\I18n\Dictionary\Writer\Csv;

use Hackathon\TranslationCollector\Module\I18n\Dictionary\Writer\Csv;

/**
 * Stdout writer
 *
 * Output csv format to stdout
 */
class Stdo extends Csv
{
    /**
     * Writer construct
     */
    public function __construct()
    {
        $this->_fileHandler = STDOUT;
    }
}
