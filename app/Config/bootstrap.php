<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 */

if (isset($_SERVER['PRODUCTION'])) {
    define('PRODUCTION', 1);
} else {
    define('PRODUCTION', 0);
}

require ROOT . DS . 'Vendor/autoload.php';
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

App::build(array(
    'Plugin' => array(
        APP . 'Plugin' . DS,
        ROOT . DS . 'Plugin' . DS,
    ),
));

App::build([
    'Service' => [
        APP . 'Service' . DS,
    ],
], App::REGISTER);

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */


/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'File',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'File',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

Configure::load('prefecture');

Configure::write('Owner.is_open', [
    '1' => '公開する',
    '0' => '公開しない',
]);


// オーナーステータス(正常)
define('OWNER_STATUS_VALID', 0);
// オーナーステータス(アカウントロック)
define('OWNER_STATUS_LOCK', 10);
// オーナーステータス(退会)
define('OWNER_STATUS_WITHDRAWAL', 20);
// パスワード間違いのロック回数
define('LOGIN_FAILER_MAX_COUNT', 6);

Configure::write('MASTER_PREFECTURES', array(
	'1' => '北海道', '2' => '青森県', '3' => '岩手県', '4' => '宮城県', '5' => '秋田県',
	'6' => '山形県', '7' => '福島県', '8' => '茨城県', '9' => '栃木県', '10' => '群馬県',
	'11' => '埼玉県', '12' => '千葉県', '13' => '東京都', '14' => '神奈川県', '15' => '新潟県',
	'16' => '富山県', '17' => '石川県', '18' => '福井県', '19' => '山梨県', '20' => '長野県',
	'21' => '岐阜県', '22' => '静岡県', '23' => '愛知県', '24' => '三重県', '25' => '滋賀県',
	'26' => '京都府', '27' => '大阪府', '28' => '兵庫県', '29' => '奈良県', '30' => '和歌山県',
	'31' => '鳥取県', '32' => '島根県', '33' => '岡山県', '34' => '広島県', '35' => '山口県',
	'36' => '徳島県', '37' => '香川県', '38' => '愛媛県', '39' => '高知県', '40' => '福岡県',
	'41' => '佐賀県', '42' => '長崎県', '43' => '熊本県', '44' => '大分県', '45' => '宮崎県',
	'46' => '鹿児島県', '47' => '沖縄県',
));


// ビール系の定数
Configure::write('MASTER_TAGS', array(
    '1' => array('name' => '蔵元', 'column' => 'company_id'),
    '2' => array('name' => 'ビールの種類','column' => 'kind'),
    '3' => array('name' => '色','column' => 'color'),
    '4' => array('name' => '味','column' => 'bitter'),
    '5' => array('name' => 'ボディ','column' => 'bottle_body'),
));

Configure::load("secret_configure");

CakePlugin::load('DebugKit');
CakePlugin::load('Migrations');
CakePlugin::load('Cakeplus');
CakePlugin::load('BoostCake');
CakePlugin::load('Upload');
CakePlugin::load('Opauth', array('routes' => true, 'bootstrap' => true));

// Using Facebook strategy as an example
Configure::write('Opauth.Strategy.Facebook', array(
    'app_id' => Configure::read("APP_FACEBOOK_APP_ID"),
    'app_secret' => Configure::read("APP_FACEBOOK_APP_SECRET"),
    'scope' => 'publish_actions,email,publish_stream'
));

function get_master_tag_names() {
    $ret = array();
    foreach (Configure::read('MASTER_TAGS') as $n => $v) {
        $ret[$n] = $v['name'];
    }
    return $ret;
}

function vd($o) {
	if ( (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] == 'production') || (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == 'aaaaa.jp') ) {
        echo '<html><head><meta charset="utf-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>';
        pr($_SERVER);
        pr($o);
        echo "</body></html>";
        exit;
	}else{
		echo '<html><head><meta charset="utf-8"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>';
		pr($o);
		echo "</body></html>";
		exit;
	}
}
