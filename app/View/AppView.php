<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 15:42
 */

App::uses('View', 'View');

/**
 * Class AppView
 *
 * @property AppFormHelper $Form
 */
class AppView extends View {


    /**
     * コンストラクタ
     *
     * @param Controller $controller
     */
    public function __construct(Controller $controller = null)
    {
        parent::__construct($controller);
    }
}