<?php

use shweshi\OpenGraph\OpenGraph;

if (!function_exists('unfurl')) {
    /**
     * Get the OGP data from an URL using micro-unfurl API
     * Doc: https://github.com/beeman/micro-unfurl
     *
     * @param string $url
     * @return array
     */
    function unfurl($url)
    {
        $urlData = [
            'url' => $url,
            'data' => null
        ];

        try {
            $og = new OpenGraph();

            $data = $og->fetch($url);

            if (count(array_keys($data)) > 0) {
                $urlData['data'] = $data;
            }
        } catch (Exception $e) {
            $urlData['data'] = null;
        }

        return $urlData;
    }
}

if (!function_exists('get_urls')) {
    /**
     * Get the URL(s) from a string.
     *
     * @param $string
     * @return array
     */
    function get_urls($string)
    {
        $result = [];

        $regex = '/https?\:\/\/[^\" \n]+/i';

        preg_match_all($regex, $string, $matches);

        foreach ($matches[0] as $url) {
            array_push($result, $url);
        }

        return $result;
    }
}

if (!function_exists('unfurl_urls')) {
    /**
     * Take a string an return a data object containing all the unfurled urls.
     *
     * @param string $string
     * @return array $result
     */
    function unfurl_string($string)
    {
        $urls = get_urls($string);
        $result = [];

        if (count($urls) > 0) {
            foreach ($urls as $url) {
                array_push($result, unfurl($url));
            }
        }

        return $result;
    }
}
