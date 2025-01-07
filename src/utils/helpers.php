<?php


function getBaseUrl($subfolder = '/public')
{
    $protocol   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host       = $_SERVER['HTTP_HOST'];
    $scriptName = dirname($_SERVER['SCRIPT_NAME']);
    $base       = rtrim($scriptName, '/\\') . $subfolder;
    return $protocol . $host . $base . '/';
}


function loadStyles(array $styles = [])
{
    $html = '';
    foreach ($styles as $style) {
        $html .= "<link rel=\"stylesheet\" href=\"$style\" />\n";
    }
    return $html;
}


function loadScripts(array $scripts = [])
{
    $html = '';
    foreach ($scripts as $script) {
        $html .= "<script src=\"$script\"></script>\n";
    }
    return $html;
}
