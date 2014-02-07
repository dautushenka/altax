<?php
namespace Altax\Command\Builtin;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class InitCommand extends \Symfony\Component\Console\Command\Command
{
    const TEMPLATE = <<<EOL
<?php
/*
|--------------------------------------------------------------------------
| Altax configurations
|--------------------------------------------------------------------------
|
| You need to modify this file for your environment.
|
*/

EOL;
    
    const COMPOSER_TEMPLATE = <<<EOL
{
  "require": {
    "php": ">=5.3.0"
  }
}

EOL;

    protected function configure()
    {
        $this
            ->setName('init')
            ->setDescription('Creates default configuration directory and files under the current directory')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configurationPath = getcwd()."/.altax/config.php";

        if (!is_file($configurationPath)) {
            $this->generateConfig($configurationPath, $output);
        } else {
            $output->writeln("<error>File '$configurationPath' is already exists. Skiped creation process.</error>");
        }

        $composerFile = dirname($configurationPath)."/composer.json";
        if (!is_file($composerFile)) {
            $this->generateComposerFile($composerFile, $output);
        } else {
            $output->writeln("<error>File '$composerFile' is already exists. Skiped creation process.</error>");
        }
     }


     protected function generateConfig($configurationPath, $output)
     {
        $fs = new Filesystem();
        $fs->mkdir(dirname($configurationPath), 0755);
        file_put_contents($configurationPath, self::TEMPLATE);
        $output->writeln("<info>Created file: </info>$configurationPath");
     }

     protected function generateComposerFile($composerFile, $output)
     {
        file_put_contents($composerFile, self::COMPOSER_TEMPLATE);
        $output->writeln("<info>Created file: </info>$composerFile");
     }
}