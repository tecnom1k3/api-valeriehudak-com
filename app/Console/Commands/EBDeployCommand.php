<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\ProcessBuilder;

class EBDeployCommand extends Command
{
    const COMMAND_GIT                 = 'git';
    const COMMAND_ZIP                 = 'zip';
    const COMMAND_REMOVE              = 'rm';
    const COMMAND_EBDEPLOYER          = 'eb_deploy';
    const EB_DEPLOYER_PROCESS_TIMEOUT = 3600;
    const BAR_SLEEP_SECS              = 3;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eb:deploy {environment=dev}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploys application using EB Deployer';

    /**
     * EBDeployCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function handle()
    {
        $this->info('---- Packing application');
        $this->removeAppArchive();
        $this->info($this->createAppArchive());
        $this->info('---- Deploying, please wait...');
        $this->info($this->deployApp());
    }

    /**
     *
     */
    protected function removeAppArchive()
    {
        $this->getNewProcessBuilder()
            ->setArguments([
                self::COMMAND_REMOVE,
                $this->getAppArchiveName(),
            ])
            ->getProcess()
            ->run();
    }

    /**
     * @return string
     */
    protected function createAppArchive()
    {
        $listGitFilesProcess = $this->getNewProcessBuilder()
            ->setArguments([
                self::COMMAND_GIT,
                'ls-files'
            ])
            ->getProcess();

        $listGitFilesProcess->run();

        $createZipProcess = $this->getNewProcessBuilder()
            ->setArguments([
                self::COMMAND_ZIP,
                $this->getAppArchiveName(),
                '-@'
            ])
            ->setInput($listGitFilesProcess)
            ->getProcess();

        $createZipProcess->run();

        return $createZipProcess->getOutput();
    }

    /**
     * @return string
     */
    protected function deployApp()
    {
        $bar = $this->output->createProgressBar();

        $ebDeployerProcess = $this->getNewProcessBuilder()
            ->setArguments([
                self::COMMAND_EBDEPLOYER,
                '-p',
                $this->getAppArchiveName(),
                '-e',
                $this->argument('environment'),
            ])->setTimeout(self::EB_DEPLOYER_PROCESS_TIMEOUT)
            ->getProcess();

        $ebDeployerProcess->start();
        $bar->start();

        while ($ebDeployerProcess->isRunning()) {
            $bar->advance();
            sleep(self::BAR_SLEEP_SECS);
        }

        $bar->finish();

        $this->line(' ');

        return $ebDeployerProcess->getOutput();
    }

    /**
     * @return ProcessBuilder
     */
    protected function getNewProcessBuilder()
    {
        return app()->make('Symfony\Component\Process\ProcessBuilder');
    }

    /**
     * @return string
     */
    protected function getAppArchiveName()
    {
        return getenv('EB_APP_FOLDER_NAME') . DIRECTORY_SEPARATOR . getenv('EB_APP_ARCHIVE_NAME');
    }
}
