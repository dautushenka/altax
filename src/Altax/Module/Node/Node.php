<?php

namespace Altax\Module\Node;

use Altax\Foundation\Module;

class Node extends Module
{
    public function foo()
    {

    }
    
    /**
     * Register node
     */
    public function set()
    {
        $node = null;
        $options = array();
        $roles = null;

        $args = func_get_args();
        if (count($args) < 2) {
            throw new \RuntimeException("Missing argument. Must 2 arguments at minimum.");
        }

        if (count($args) === 2) {
            $node = $args[0];
            
            if (is_string($args[1]) || is_vector($args[1])) {
                $roles = $args[1];
            } else {
                if (isset($args[1]['roles'])) {
                    $roles = $args[1]['roles'];
                    unset($args[1]['roles']);
                }
                $options = $args[1];
            }
        } else {
            $node = $args[0];
            $options = $args[1];
            $roles = $args[2];
        }

        $this->getContainer()->set("nodes/$node", $options);

    }
}