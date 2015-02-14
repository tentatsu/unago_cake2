<?php
class CreateFirstTables extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
    public $description = 'create_first_tables';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
    public $migration = array(
        'up' => array(
            'create_table' => array(
                'addresses' => array(
                    'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'owner_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
                    'zip1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'zip2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 4, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'address1' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'address2' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'tel' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                        'addresses_fk_owner_id' => array('column' => 'owner_id', 'unique' => 0),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
                'companies' => array(
                    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
                'owner_registrations' => array(
                    'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'email' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'registration_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                        'email' => array('column' => 'email', 'unique' => 1),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
                'owners' => array(
                    'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'company_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false, 'key' => 'index'),
                    'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'last_name_kana' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'first_name_kana' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'section' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'email' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'prefecture' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'is_open' => array('type' => 'boolean', 'null' => true, 'default' => null),
                    'password_reminder_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'password_reminder_token' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'owner_status' => array('type' => 'integer', 'null' => true, 'default' => 0, 'length' => 6, 'unsigned' => false),
                    'login_failure_number' => array('type' => 'integer', 'null' => true, 'default' => 0, 'length' => 6, 'unsigned' => false),
                    'lock_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                        'email' => array('column' => 'email', 'unique' => 1),
                        'owners_fk_company_id' => array('column' => 'company_id', 'unique' => 0),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),

                'question_choices' => array(
                    'questionnaire_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
                    'question_option_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
                    'indexes' => array(
                        'q2c_fk_quesionnaire_id' => array('column' => 'questionnaire_id', 'unique' => 0),
                        'q2c_fk_q2o_id' => array('column' => 'question_option_id', 'unique' => 0),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
                'question_options' => array(
                    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'question_number' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6, 'unsigned' => false),
                    'is_others' => array('type' => 'boolean', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
                'questionnaires' => array(
                    'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'owner_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
                    'question_number' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6, 'unsigned' => false),
                    'answer' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'answer_others' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
                    'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                        'questionnaires_fk_owner_id' => array('column' => 'owner_id', 'unique' => 0),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB'),
                ),
            ),
        ),
        'down' => array(
            'drop_table' => array(
                'addresses', 'companies', 'owner_registrations', 'owners', 'pet_classifications', 'pets', 'question_choices', 'question_options', 'questionnaires'
            ),
        ),
    );

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
    public function before($direction) {
        if ($direction === 'down') {
            $this->db->execute("SET SESSION FOREIGN_KEY_CHECKS=0;");
        }
        return true;
    }

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
    public function after($direction) {
        if ($direction === 'up') {
            $this->db->execute("alter table companies change column id id int not null;");
            $this->db->execute("alter table pet_classifications change column id id int not null;");
            $this->db->execute("alter table question_options change column id id int not null;");

            $this->db->query("ALTER TABLE owners ADD CONSTRAINT owners_fk_company_id FOREIGN KEY (company_id) REFERENCES companies (id) ON UPDATE CASCADE ON DELETE SET NULL ;");
            $this->db->query("ALTER TABLE addresses ADD CONSTRAINT addresses_fk_owner_id FOREIGN KEY (owner_id) REFERENCES owners (id) ON UPDATE CASCADE ON DELETE CASCADE ;");
            $this->db->query("ALTER TABLE pets ADD CONSTRAINT pets_fk_owner_id FOREIGN KEY (owner_id) REFERENCES owners (id) ON UPDATE CASCADE ON DELETE CASCADE ;");
            $this->db->query("ALTER TABLE questionnaires ADD CONSTRAINT questionnaires_fk_owner_id FOREIGN KEY (owner_id) REFERENCES owners (id) ON UPDATE CASCADE ON DELETE CASCADE ;");
            $this->db->query("ALTER TABLE pets ADD CONSTRAINT pets_fk_pet_classification_id FOREIGN KEY (pet_classification_id) REFERENCES pet_classifications (id) ON UPDATE CASCADE ON DELETE SET NULL ;");
            $this->db->query("ALTER TABLE question_choices ADD CONSTRAINT q2c_fk_quesionnaire_id FOREIGN KEY (questionnaire_id) REFERENCES questionnaires (id) ON UPDATE CASCADE ON DELETE CASCADE ;");
            $this->db->query("ALTER TABLE question_choices ADD CONSTRAINT q2c_fk_q2o_id FOREIGN KEY (question_option_id) REFERENCES question_options (id) ON UPDATE CASCADE ON DELETE CASCADE ;");

            $this->db->query("insert into companies(id, name, created, modified) values(1, 'MSD株式会社', NOW(), NOW());");
            $this->db->query("insert into companies(id, name, created, modified) values(2, '日産化学工業株式会社', NOW(), NOW());");
            $this->db->query("insert into companies(id, name, created, modified) values(3, '株式会社インターペット(MSDアニマルヘルス)', NOW(), NOW());");

            $this->db->query("insert into pet_classifications(id, name, created, modified) values(1, '犬', NOW(), NOW());");
            $this->db->query("insert into pet_classifications(id, name, created, modified) values(2, '猫', NOW(), NOW());");
            $this->db->query("insert into pet_classifications(id, name, created, modified) values(1000, 'その他', NOW(), NOW());");

            $question_options = [
                ['とても気を使っている', 1, 0],
                ['まぁまぁ気を使っている', 1, 0],
                ['どちらともいえない', 1, 0],
                ['あまり気を使っていない', 1, 0],
                ['全く気を使っていない', 1, 0],

                ['食事の量や原材料に気を付ける', 2, 0],
                ['シャンプーやブラッシングをする', 2, 0],
                ['よく運動させる', 2, 0],
                ['定期健診', 2, 0],
                ['全清潔な飼育環境（ペットサークルの掃除など）', 2, 0],
                ['スキンシップをとる', 2, 0],
                ['サプリメントなどを与える', 2, 0],
                ['わからない/していない', 2, 0],
                ['その他', 2, 1],

                ['1ヵ月に1回', 3, 0],
                ['2～3ヵ月に1回', 3, 0],
                ['半年に1回', 3, 0],
                ['1年に1回程度', 3, 0],
                ['数年に1回程度', 3, 0],
                ['いったことがない', 3, 0],

                ['犬のフィラリア症予防', 4, 0],
                ['ノミ・ダニ対策', 4, 0],
                ['混合ワクチン', 4, 0],
                ['狂犬病', 4, 0],
                ['健康診断', 4, 0],
                ['わからない/していない', 4, 0],
                ['その他', 4, 1],

                ['大変よい', 5, 0],
                ['まあまあ良い', 5, 0],
                ['ふつう', 5, 0],
                ['あまりよくない', 5, 0],
                ['非常に良くない', 5, 0],

                ['事業内容も全て知っている', 6, 0],
                ['事業内容は知らないが会社名は知っている。', 6, 0],
                ['会社名を聞いたことがある', 6, 0],
                ['知らない', 6, 0],

                ['イムロース：犬用健康補助食品（ニゲロオリゴ糖配合・シロップ状サプリメント）', 7, 0],
                ['グリコフレックスI EX：犬用健康補助食品 関節に配慮した健康食品', 7, 0],
                ['オメガ3,6,：犬猫用健康補助食品 オメガ脂肪酸サプリメント', 7, 0],
                ['ジルケーン：犬猫用健康補助食品 アルファ-Ｓ1 トリプシン カゼイン（牛乳由来）含有', 7, 0],
                ['犬甲状腺機能低下症治療薬レベンタ：犬の甲状腺機能低下症の臨床症状の改善', 7, 0],
                ['動物用イソフルラン：犬用全身麻酔薬', 7, 0],
                ['動物用プロポフォール１％注「マイラン」：プロポフォール1％製剤 全身麻酔薬（速やかな導入と覚醒）', 7, 0],
                ['オプティミューン眼軟膏：犬の乾性角結膜炎の症状の改善', 7, 0],
                ['ノビバック：犬猫用混合ワクチン', 7, 0],
                ['松研狂犬病ＴＣワクチン：犬及び猫の狂犬病の予防', 7, 0],
                ['バソトップＰ：犬用ＡＣＥ阻害剤 犬の僧帽弁閉鎖不全による心不全の改善', 7, 0],
                ['動物用マイメジン細粒：猫の慢性腎不全における尿毒症症状の発現の抑制', 7, 0],
                ['モメタオティック：犬用外耳炎治療薬', 7, 0],
                ['スペシフィック：犬猫用食事療法食', 7, 0],
                ['わからない', 7, 0],

                ['知っている', 8, 0],
                ['知らない', 8, 0],

                ['知っている', 9, 0],
                ['知らない', 9, 0],

                ['心臓病', 10, 0],
                ['消化器病', 10, 0],
                ['犬のフィラリア症', 10, 0],
                ['ノミ・ダニ対策用', 10, 0],
                ['皮膚病', 10, 0],
                ['眼科用', 10, 0],

                ['使ってみたい', 11, 0],
                ['使いたくない', 11, 0],

                ['使ってみたい', 12, 0],
                ['使いたくない', 12, 0],

                ['はい', 13, 0],
                ['いいえ', 13, 0],
            ];

            $i = 1;
            foreach ($question_options as $question_option) {
                $this->db->query(sprintf("insert into question_options(id, name, question_number, is_others) values(%d, '%s', %d, %d);", $i, $question_option[0], $question_option[1], $question_option[2]));
                $i++;
            }
        }
        return true;
    }
}
