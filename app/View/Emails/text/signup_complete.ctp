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
名前（カナ）：<?= h($owner['Owner']['kana']); ?>
会社名 ：<?= h($owner['Company']['name']); ?>
部署名 ：<?= h($owner['Owner']['section']) ?>
メールアドレス：<?= h($owner['Owner']['email']) ?>
お住まい（都道府県）：<?= h(Configure::read('Prefectures.' . $owner['Owner']['prefecture'])); ?>

郵便番号：
住所：
建物名・号室：
電話番号：

<?php foreach ($owner['Pet'] as $pet): ?>
PandY ID：<?= sprintf("%08d", $pet['id']); ?>
種別：<?= h($pet['PetClassification']['name']) ?>
名前：<?= h($pet['name']) ?>
性別：<?= h(Configure::read('Pet.sex.' . $pet[sex])) ?>
犬種、猫種：<?= h($pet['classification']) ?>
年齢：<?= h(Configure::read('Pet.age.' . $pet['age'])) ?>
写真：xxxxxxx.jpg
<?php if (!empty($pet['message'])): ?>
メッセージ：<?= $pet['message'] ?>
<?php endif; ?>

<?php endforeach; ?>
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