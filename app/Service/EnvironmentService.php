<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 15:53
 */

/**
 * Class EnvironmentService
 */
class EnvironmentService {
    const ENV_PRODUCTION = 'production';
    const ENV_STAGING = 'staging';
    const ENV_DEVELOPMENT = 'development';
    const ENV_LOCAL = 'local';

    private static $_instance;
    private $_env;

    /**
     * @param $env
     */
    private function __construct($env)
    {
        $this->_env = empty($env) ? self::ENV_PRODUCTION : $env;
    }

    /**
     * @return EnvironmentService
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self(getenv('PANDY_ENV'));
        }
        return self::$_instance;
    }

    /**
     * @param $env
     */
    public static function setEnv($env)
    {
        $instance = self::getInstance();
        $instance->_env = $env;
    }

    /**
     * 指定の環境か確認する
     *
     * @param string $target
     * @return bool
     */
    public static function isEnv($target = self::ENV_PRODUCTION)
    {
        $instance = self::getInstance();
        return $target === $instance->_env;
    }

    /**
     * 本番環境か確認する
     *
     * @return bool
     */
    public static function isProduction()
    {
        return self::isEnv(self::ENV_PRODUCTION);
    }

    /**
     * ステージング環境か確認する
     *
     * @return bool
     */
    public static function isStaging()
    {
        return self::isEnv(self::ENV_STAGING);
    }

    /**
     * 開発サーバーか確認する
     *
     * @return bool
     */
    public static function isDevelopment()
    {
        return self::isEnv(self::ENV_DEVELOPMENT);
    }

    /**
     * 開発環境か確認する
     *
     * @return bool
     */
    public static function isLocal()
    {
        return self::isEnv(self::ENV_LOCAL);
    }
}