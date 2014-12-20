<?php
App::uses('AppModel', 'Model');
/**
 * Questionnaire Model
 *
 * @property Owner $Owner
 */
class Questionnaire extends AppModel {

    public $belongsTo = [
        'Owner',
    ];
}
