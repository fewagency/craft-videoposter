<?php
namespace Craft;

class VideoPosterPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('YouTube Poster Getter');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Mattias Hinderson';
    }

    function getDeveloperUrl()
    {
        return 'http://fewagency.se';
    }
}
