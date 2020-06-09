<?php
    function setActiveRoute($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }

    function setActiveNavDrop($name)
    {
        return request()->routeIs($name) ? 'menu-open' : '';
    }
    
?>