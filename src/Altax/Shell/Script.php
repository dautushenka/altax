<?php
namespace Altax\Shell;

use Symfony\Component\Process\Process as SymfonyProcess;

class Script
{
    protected $path;
    protected $process;
    protected $node;
    protected $output;
    protected $options = array();
    protected $env;

    public function __construct($path, $process, $output, $env)
    {
        $this->path = $path;
        $this->process = $process;
        $this->node = $process->getNode();
        $this->output = $output;
        $this->env = $env;
    }

}