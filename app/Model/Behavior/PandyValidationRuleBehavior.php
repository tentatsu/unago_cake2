<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 10:09
 */

class PandyValidationRuleBehavior extends ModelBehavior {

    /**
     * @param Model $Model
     * @param array $settings
     */
    public function setup(Model $Model, $settings = array())
    {
        if (!isset($this->settings[$Model->alias])) {
            $this->settings[$Model->alias] = array();
        }
        $this->settings[$Model->alias] = array_merge($this->settings[$Model->alias], (array)$settings);
    }

    /**
     * 英数字のバリデーション
     *
     * @param Model $Model
     * @param $check
     * @return bool|int
     */
    public function english(Model $Model, $check)
    {
        if (empty($check)) {
            return true;
        }
        $value = array_shift($check);
        return preg_match("/^[[:print:]]*$/ui", $value);
    }

    /**
     * モデルのIDとして存在するかチェック
     *
     * @param Model $Model
     * @param $check
     * @param $modelName
     * @return bool
     */
    public function hasModelId(Model $Model, $check, $modelName)
    {
        if (empty($check)) {
            return true;
        }
        $value = array_shift($check);
        $model = ClassRegistry::init($modelName);
        return $model->exists($value);

    }

    /**
     * 都道府県が正しいかチェック
     *
     * @param Model $Model
     * @param $check
     * @return bool
     */
    public function hasPrefecture(Model $Model, $check)
    {
        return $this->hasConfiguration($Model, $check, 'Prefectures');
    }

    /**
     * 設定ファイルに値が含まれているかチェック
     *
     * @param Model $Model
     * @param $check
     * @param $key
     * @return bool
     */
    public function hasConfiguration(Model $Model, $check, $key)
    {
        if (empty($check)) {
            return true;
        }

        $value = array_shift($check);
        $values = Configure::read($key);
        return array_key_exists($value, $values);
    }

    /**
     * 郵便番号のバリデーション
     *
     * @param Model $Model
     * @param $check
     * @return boolean
     */
    public function zip1(Model $Model, $check)
    {
        if (empty($check)) {
            return true;
        }
        $value = array_shift($check);
        return preg_match("/^[0-9]{3}$/ui", $value);
    }

    /**
     * 郵便番号のバリデーション
     *
     * @param Model $Model
     * @param $check
     * @return boolean
     */
    public function zip2(Model $Model, $check)
    {
        if (empty($check)) {
            return true;
        }
        $value = array_shift($check);
        return preg_match("/^[0-9]{4}$/ui", $value);
    }
}