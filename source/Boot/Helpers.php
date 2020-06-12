<?php

/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * 
 * @param array $data
 * @return array
 */
function filter_array(array $data): Array {
    $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
    $data = array_map('trim', $data);

    return $data;
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string|null $uri
 * @return string
 */
function url(string $uri = null): string {
    if ($uri) {
        return ROOT . "/{$uri}";
    }

    return ROOT;
}


/**
 * ####################
 * ###   ASSETS   #####
 * ####################
 */

/**
 * Checks and returns the project url to the theme
 * @param string $path
 * @return string
 */
function theme(string $path = null): string {
    if ($path) {
        return ROOT . "/views/main/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return ROOT . "/views/main";
}

/**
 * Limit requisitions
 * @param string $key
 * @param int $limit
 * @param int $seconds
 * @return bool
 */
function request_limit(string $key, int $limit = 5, int $seconds = 60): bool {   
    if (isset($_SESSION[$key]) && $_SESSION[$key]["time"] >= time() && $_SESSION[$key]["requests"] < $limit) {
        $_SESSION[$key] = [
            "time" => time() + $seconds,
            "requests" => $_SESSION[$key]["requests"] + 1
        ];
        return false;
    }

    if (isset($_SESSION[$key]) && $_SESSION[$key]["time"] >= time() && $_SESSION[$key]["requests"] >= $limit) {
        return true;
    }

    $_SESSION[$key] = [
        "time" => time() + $seconds,
        "requests" => 1
    ];

    return false;
}
