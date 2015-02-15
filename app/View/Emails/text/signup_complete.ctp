<?php
/**
 * Created by IntelliJ IDEA.
 * User: booyan
 * Date: 14/12/14
 * Time: 16:52
 *
 * @var $this View
 * @var $owner array
 */
?>
<?= h($owner['Owner']['name']); ?> 様
マイページ：（<?= $this->Html->url(['controller' => 'owners', 'action' => 'mypage'], true); ?>）

「PandY」へ会員登録いただきましてありがとうございます。
受付が完了致しましたので、ご登録の内容をお送り致します。

受付日：<?= strftime('%Y年%m月%d日'); ?>
名前(漢字）：<?= h($owner['Owner']['name']); ?>
メールアドレス：<?= h($owner['Owner']['email']) ?>


【ご注意】
◆このメールは会員登録時のメールアドレスに間違いがないかご本人様に確認いただくものです。メールに覚えがない場合は破棄いただくか、下記よりお問い合わせください。
◆メールアドレスは配信専用のため、本メールへの返信は受付できません。あらかじめご了承ください。
◆ご利用に際してご不明の点がございましたら、下記URLよりご確認ください。

【PandY ペットアンドユウ】
http://www.petandyou.jp

MSD株式会社、株式会社インターベット（MSDアニマルヘルス）
http://www.msd-animal-health.jp/privacy.aspx 

日産化学工業株式会社
http://www.nissanchem.co.jp/site/policy.html