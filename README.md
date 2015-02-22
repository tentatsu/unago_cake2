# 開発環境の構築手順

## githubからunago_defaultリポジトリをクローンする
githubのリモートリポジトリからローカルリポジトリをクローンしてください。

```
$ git clone git@github.com:tentatsu/unago_cake2.git
```

## ComposerでCakePHPやプラグインをインストールする
Composerが未インストールの時はインストールしてください。  
pandyフォルダ内に入って下記のコマンドを実行してください。

https://getcomposer.org/

```
$ composer install
または
$ php composer.phar install
```

## tmpフォルダに書き込み権限を与える
ログやキャッシュの書き込みに必要なフォルダ以下にApache実行ユーザーが
書き込みを行えるように権限を与えてください。


```
$ mkdir -p ./app/tmp/logs
$ mkdir -p ./app/tmp/sessions
$ mkdir -p ./app/tmp/cache/persistent
$ mkdir -p ./app/tmp/cache/models
$ chmod -R 777  ./app/tmp
$ chmod 777 ./app/Console/cake
```


## .htaccessを用意する
app/webrootフォルダに.htaccessを用意してください。

```
$ cp ./app/Config/local/_htaccess ./app/webroot/.htaccess
```

## 設定ファイルを用意する
core.php、database.php、email.phpを用意してください。
app/Config/localフォルダ内にサンプル用意してありますので、コピーして利用するか参考にしてください。

```
$ cp ./app/Config/local/core.php ./app/Config/core.php
$ cp ./app/Config/local/database.php ./app/Config/database.php
$ cp ./app/Config/local/email.php ./app/Config/email.php
```

## .gitignoreの追加
secretな設定ファイルを間違って登録しないためgitignoreを書き換えます。

```
vi ./.gitignore

#/app/Config/secret_configure.php
この行の#を取る。
```

## DBを構築する
/db/create_db.sqlを使用してunago_defaultのDBを作成してください。

```
$ mysql -u root -p < ./db/create_db.sql
```

## DBにテーブルを用意する
DBのテーブル管理にはCakePHPのMigrationsプラグインを使用します。
DB作成後にntsフォルダで以下のコマンドを実行してください。

※php.iniにdate.timezoneを設定していない場合は、設定してください。

```
$vi /etc/php.ini

date.timezone = "Asia/Tokyo"
```


まずはMigrations関連のテーブルを作成します。

```
$ ./app/Console/cake Migrations.migration run all -p Migrations
```

続いてpandyのテーブルを作成します。

```
$ ./app/Console/cake Migrations.migration run all
```

## バーチャルホストの設定をする
/app/webrootフォルダをWEBルートとするバーチャルホストを設定してください。
HTTPSでの接続が必要になる箇所もありますので
HTTPSで接続出来るようにバーチャルホストの設定をお願いします。


```
# サンプル
<VirtualHost *:80>
ServerName unago_default.localhost
DocumentRoot /var/www/html/unago_default

<Directory "/var/www/html/unago_default">
    Allow from all
</Directory>

</VirtualHost>
```

## 動作確認をする
WEBサーバーを起動して、動作確認をしてください。
例えばドメインがunago_default.localhostの場合は以下の様なURLとなります。

|名称|URL|備考|
|-----|------|------|
|トップページ|http://unago_default.localhost||
