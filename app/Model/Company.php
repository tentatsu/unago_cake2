<?php
App::uses('AppModel', 'Model');
/**
 * Company Model
 *
 * @property Owner $Owner
 */
class Company extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'name';

    public $hasMany = [
        'Owner',
    ];
}
