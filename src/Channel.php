<?php

namespace VidBitFuture\VBF;

/**
 * Class Channel
 * @package VidBitFuture\VBF
 */
class Channel
{
    const BASE_URL = 'https://vidbitfuture.pro';

    /**
     * @var object
     */
    public static $info;
    /**
     * @var int
     */
    public static $user_id;

    /**
     * @param string $channel_name
     * @return int
     */
    public static function channel_id($channel_name)
    {
        if (is_null(self::$user_id)) {
            $request_url = self::BASE_URL . '/userinfo.php?id=' . '/user_to_id.php?username=' . $channel_name;
            if (self::get_http_response_code($request_url) == "200") {
                $response = file_get_contents($request_url);
                self::$info = json_decode($response);
            }
        }

        return self::$user_id;
    }

    /**
     * @param int $channel_id
     * @return mixed
     */
    public static function populate($channel_id = null)
    {
        if ($channel_id == null) {
            $channel_id = self::$user_id;
        }
        if (!isset(self::$info->id) || is_null(self::$info->id)) {
            $request_url = self::BASE_URL . '/userinfo.php?id=' . (int)$channel_id;

            if (self::get_http_response_code($request_url) == "200") {
                $response = file_get_contents($request_url);
                self::$info = json_decode($response);
            }
        }

        if (is_null(self::$info)) {
            // Set defaults
            self::$info = (object)[
                'id' => 0,
                'username' => 'User Not Found',
                'subcount' => 0
            ];
        }

        return self::$info;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function get($name)
    {
        if (isset(self::$info->$name)) {
            return self::$info->$name;
        }
        return null;
    }

    private static function get_http_response_code($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
}