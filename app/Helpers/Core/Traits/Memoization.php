<?php


namespace App\Helpers\Core\Traits;


trait Memoization
{
    protected static $memoized = [];

    /**
     * Memoize Operation Result
     * @param $key
     * @param \Closure $callback
     * @param bool $refresh
     * @return mixed
     */
    public function memoize($key, \Closure $callback, bool $refresh)
    {
        if (!isset(static::$memoized[$key]) || $refresh) {
            return static::$memoized[$key] = $callback();
        }
        return static::$memoized[$key];
    }
}
