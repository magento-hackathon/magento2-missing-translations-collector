<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Console\Command;

use Magento\Setup\Module\I18n\ServiceLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for i18n
 */
class I18nCollectTranslationsCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('i18n:collect-translations')
            ->setDescription('Collect all Translatable strings');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = ServiceLocator::getDictionaryGenerator();
        $generator->generate(
            BP, // Full installation
            'var/tmp/collected_translations.csv',
            true
        );
        $output->writeln('<info>Collected Translatable Strings</info>');
    }
}
