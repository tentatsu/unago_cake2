<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/13
 * Time: 20:49
 *
 * @var $this View
 * @var $owner array
 */
?>
下記のURLにアクセスし、パスワードの再設定を行って下さい。

パスワード再設定用URL
<?= $this->Html->url(['controller' => 'owners', 'action' => 'passwordChangeConfirm', $owner['Owner']['id'], $owner['Owner']['password_reminder_token']], true); ?>


セキュリティ上の理由で、URLの有効期限は24時間です。
有効期限が過ぎた場合はお手数ですが、再度登録をお願い致します。


【ご注意】
◆このメールはパスワード再設定時のメールアドレスに間違いがないかご本人様に確認いただくものです。
◆メールアドレスは配信専用のため、本メールへの返信は受付できません。あらかじめご了承ください。

【PandY ペットアンドユウ】
http://www.petandyou.jp

MSD株式会社、株式会社インターベット（MSDアニマルヘルス）
http://www.msd-animal-health.jp/privacy.aspx 

日産化学工業株式会社
http://www.nissanchem.co.jp/site/policy.html