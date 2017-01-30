<?php
namespace Craft;

class VideoPosterVariable
{
    private function parseYouTubeURL($url)
    {
        $urls = parse_url($url);

        // url is http://youtu.be/abcd
        if ($urls['host'] == 'youtu.be') {
            $id = ltrim($urls['path'],'/');
        }

        // url is http://www.youtube.com/embed/abcd
        else if(strpos($urls['path'], 'embed') == 1) {
            $id = end(explode('/',$urls['path']));
        }

         // url is xxxx only
        else if(strpos($url,'/')===false){
            $id = $url;
        }

        // http://www.youtube.com/watch?feature=player_embedded&v=ML2KAaR26Pk
        // url is http://www.youtube.com/watch?v=ML2KAaR26Pk
        else {
            parse_str($urls['query'], $parsed_query);
            $id = $parsed_query['v'];
        }

        return 'http://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
    }

    private function parseVimeoURL($url)
    {
        $vimeoId = (int) substr(parse_url($url, PHP_URL_PATH), 1);
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeoId.php"));

        return $hash[0]['thumbnail_large'];
    }

    public function getPoster($url)
    {
        if (strpos($url, 'youtube') > 0) {
            $videoPoster = $this->parseYouTubeURL($url);
        } elseif (strpos($url, 'vimeo') > 0) {
            $videoPoster = $this->parseVimeoURL($url);
        }

        return $videoPoster;
    }
}
