<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $actsAs = [
        'Containable',
        'Cakeplus.AddValidationRule',
        'PandyValidationRule',
    ];

    /**
     * begin
     */
    public function begin()
    {
        $db = $this->getDataSource();
        $db->begin();
    }

    /**
     * commit
     */
    public function commit()
    {
        $db = $this->getDataSource();
        $db->commit();
    }

    /**
     * rollback
     */
    public function rollback()
    {
        $db = $this->getDataSource();
        $db->rollback();
    }
}
