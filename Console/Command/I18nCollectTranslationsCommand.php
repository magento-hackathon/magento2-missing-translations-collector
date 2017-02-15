<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hackathon\TranslationCollector\Console\Command;

use Hackathon\TranslationCollector\Module\I18n\ServiceLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\ObjectManager;

/**
 * Command for i18n
 */
class I18nCollectTranslationsCommand extends Command
{

    const INPUT_KEY_DIRECTORY = 'directory';
    const INPUT_KEY_OUTPUT = 'output';
    const SHORTCUT_KEY_OUTPUT = 'o';
    const INPUT_KEY_MAGENTO = 'magento';
    const SHORTCUT_KEY_MAGENTO = 'm';
    const INPUT_KEY_STORE = 'store';
    const SHORTCUT_KEY_STORE = 's';

    protected function configure()
    {
        $this->setName('i18n:collect-translations')
            ->setDescription('Collect all Translatable strings');
        $this->setDefinition([
            new InputArgument(
                self::INPUT_KEY_DIRECTORY,
                InputArgument::OPTIONAL,
                'Directory path to parse. Not needed if --magento flag is set'
            ),
            new InputOption(
                self::INPUT_KEY_OUTPUT,
                self::SHORTCUT_KEY_OUTPUT,
                InputOption::VALUE_REQUIRED,
                'Path (including filename) to an output file. With no file specified, defaults to stdout.'
            ),
            new InputOption(
                self::INPUT_KEY_MAGENTO,
                self::SHORTCUT_KEY_MAGENTO,
                InputOption::VALUE_NONE,
                'Use the --magento parameter to parse the current Magento codebase.' .
                ' Omit the parameter if a directory is specified.'
            ),
            new InputOption(
                self::INPUT_KEY_STORE,
                self::SHORTCUT_KEY_STORE,
                InputOption::VALUE_REQUIRED,
                'Use the --store parameter to parse store.' .
                ' Omit the parameter if a directory is specified.'
            ),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Collected Translatable Strings</info>');

        $directory = $input->getArgument(self::INPUT_KEY_DIRECTORY);
        if ($input->getOption(self::INPUT_KEY_MAGENTO)) {
            $directory = BP;
            if ($input->getArgument(self::INPUT_KEY_DIRECTORY)) {
                throw new \InvalidArgumentException('Directory path is not needed when --magento flag is set.');
            }
        } elseif (!$input->getArgument(self::INPUT_KEY_DIRECTORY)) {
            throw new \InvalidArgumentException('Directory path is needed when --magento flag is not set.');
        }
        $generator = ServiceLocator::getDictionaryGenerator();
        $objectManager = ObjectManager::getInstance();
        $emulation = $objectManager->create('\Magento\Store\Model\App\Emulation');
        $emulation->startEnvironmentEmulation($input->getOption(self::INPUT_KEY_STORE));
        $generator->generate(
            $directory,
            $input->getOption(self::INPUT_KEY_OUTPUT),
            $input->getOption(self::INPUT_KEY_MAGENTO)

        );
        $emulation->stopEnvironmentEmulation();
        $output->writeln('<info>Collected Translatable Strings</info>');
    }
}
