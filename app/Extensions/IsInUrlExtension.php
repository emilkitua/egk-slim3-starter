<?php

class IsInUrlExtension extends \Twig_Extension
{
    public function __construct($currentUrl)
    {
        $this->currentUrl;
    }

    public function getName()
    {
        return 'extName';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('is_in_url', [$this, 'isInUrl'])
        ];
    }

    public function isInUrl(string $substr) : bool
    {
        return strpos($this->currentUrl, $substr) !== false;
    }
}