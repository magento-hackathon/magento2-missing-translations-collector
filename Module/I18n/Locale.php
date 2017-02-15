<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Module\I18n;

/**
 *  Locale
 */
class Locale
{
    /**
     * Default system locale
     */
    const DEFAULT_SYSTEM_LOCALE = 'de_DE';

    /**
     * Locale name
     *
     * @var string
     */
    protected $_locale;

    /**
     * Locale construct
     *
     * @param string $locale
     * @throws \InvalidArgumentException
     */
    public function __construct($locale)
    {
        if (!preg_match('/[a-z]{2}_[A-Z]{2}/', $locale)) {
            throw new \InvalidArgumentException('Target locale must match the following format: "aa_AA".');
        }
        $this->_locale = $locale;
    }

    /**
     * Return locale string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->_locale;
    }
}
