<?php

/**
 * Generation migrate by PIXELION CMS
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 *
 * Class m170518_123701_faq
 */

use yii\db\Migration;
use panix\mod\faq\models\Faq;
use panix\mod\faq\models\FaqTranslate;

class m170518_123701_faq extends Migration
{

    public $text = 'Lorem ipsum dolor sit amet, consecte dunt ut labore et dot nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(Faq::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'category_id' => $this->integer()->unsigned(),
            'ordern' => $this->integer()->unsigned(),
            'switch' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null()
        ], $tableOptions);


        $this->createTable(FaqTranslate::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'object_id' => $this->integer()->unsigned(),
            'language_id' => $this->tinyInteger()->unsigned(),
            'question' => $this->text(),
            'answer' => $this->text(),
        ], $tableOptions);


        $this->createIndex('switch', Faq::tableName(), 'switch');
        $this->createIndex('ordern', Faq::tableName(), 'ordern');
        $this->createIndex('user_id', Faq::tableName(), 'user_id');
        $this->createIndex('category_id', Faq::tableName(), 'category_id');

        $this->createIndex('object_id', FaqTranslate::tableName(), 'object_id');
        $this->createIndex('language_id', FaqTranslate::tableName(), 'language_id');

        if ($this->db->driverName != "sqlite") {
            $this->addForeignKey('{{%fk_faq_translate}}', FaqTranslate::tableName(), 'object_id', Faq::tableName(), 'id', "CASCADE", "NO ACTION");
        }

        $columns = ['user_id', 'ordern', 'created_at'];
        $this->batchInsert(Faq::tableName(), $columns, [
            [1, 1, time()],
            [1, 2, time()],
        ]);


        $columns = ['object_id', 'language_id', 'question', 'answer'];
        $this->batchInsert(FaqTranslate::tableName(), $columns, [
            [1, 1, 'faq 1', $this->text],
            [2, 1, 'faq 2', $this->text],
        ]);
    }

    public function down()
    {
        if ($this->db->driverName != "sqlite") {
            $this->dropForeignKey('{{%fk_faq_translate}}', FaqTranslate::tableName());
        }
        $this->dropTable(Faq::tableName());
        $this->dropTable(FaqTranslate::tableName());
    }

}
