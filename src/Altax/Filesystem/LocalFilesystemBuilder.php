<?php
namespace Altax\Filesystem;

class LocalFilesystemBuilder
{
    protected $runtime;
    protected $output;
    protected $env;

    public function __construct($commandBuilder, $runtime, $output)
    {
        $this->commandBuilder = $commandBuilder;
        $this->runtime = $runtime;
        $this->output = $output;
    }

    public function make()
    {
        return new LocalFilesystem(
            $this->commandBuilder,
            $this->runtime->getProcess(),
            $this->output
            );
    }

    public function exists($path)
    {
        return $this->make()->exists($path);
    }

    public function remove($path)
    {
        return $this->make()->remove($path);
    }
}
