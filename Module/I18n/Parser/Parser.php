<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Module\I18n\Parser;

use \Magento\Framework\Translate;

/**
 * Parser
 */
class Parser extends AbstractParser
{
	
    /**
     * Parse one type
     *
     * @param array $options
     * @return void
     */
    protected function _parseByTypeOptions($options)
    {
        foreach ($this->_getFiles($options) as $file) {
            $adapter = $this->_adapters[$options['type']];
            $adapter->parse($file);

            foreach ($adapter->getPhrases() as $phraseData) {
                $this->_addPhrase($phraseData);
            }
        }
    }

    /**
     * Add phrase
     *
     * @param array $phraseData
     * @return void
     */
    protected function _addPhrase($phraseData)
    {
	    try {
            $foundTranslation = $this->_translatePhrase($phraseData['phrase']);
            if (!$foundTranslation) {
                $phrase = $this->_factory->createPhrase([
                    'phrase' => $phraseData['phrase'],
                    'translation' => '',
                    'quote' => $phraseData['quote'],
                ]);
                $this->_phrases[$phrase->getCompiledPhrase()] = $phrase;
            }
        } catch (\DomainException $e) {
            throw new \DomainException(
                "{$e->getMessage()} in {$phraseData['file']}:{$phraseData['line']}",
                $e->getCode(),
                $e
            );
        }
    }

	protected function _translatePhrase($phrase)
	{
	    $translations = $this->getTranslations();
		if(array_key_exists($phrase, $translations)){
	        return $translations[$phrase];
		}else{
			return false;
		}
	}
}
