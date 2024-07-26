<?php

function breadcrumbs()
{
    $routeName = request()->getPathInfo();
    $handlePath = explode('/', $routeName);
    array_shift($handlePath);

    return $handlePath;
}