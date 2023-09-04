<?php

function loadClass($classe)
{
    // Vérifiez si la classe est un repository (Repository)
    if (substr($classe, -strlen('Repository')) === 'Repository') {
        require_once 'repository/' . $classe . '.php';
    } else {
        // Vérifiez si la classe est une factory (Factory)
        if (substr($classe, -strlen('Factory')) === 'Factory') {
            require_once 'factory/' . $classe . '.php';
        } else {
            // Vérifiez si la classe est une interface (Interface)
            if (substr($classe, -strlen('Interface')) === 'Interface') {
                require_once 'interface/' . $classe . '.php';
            } else {
                require_once 'entity/' . $classe . '.php';
            }
        }
    }
}

spl_autoload_register('loadClass');