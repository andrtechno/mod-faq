<?php

/**
 * Generation migrate by PIXELION CMS
 * @author PIXELION CMS development team <dev@pixelion.com.ua>
 *
 * Class m170711_126300_faq_categories
 */

use yii\db\Migration;
use panix\mod\faq\models\FaqCategory;
use panix\mod\faq\models\FaqCategoryTranslate;

class m170711_126300_faq_categories extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(FaqCategory::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned(),
            'ordern' => $this->integer()->unsigned(),
            'switch' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(11)->null(),
            'updated_at' => $this->integer(11)->null()
        ], $tableOptions);


        $this->createTable(FaqCategoryTranslate::tableName(), [
            'id' => $this->primaryKey()->unsigned(),
            'object_id' => $this->integer()->unsigned(),
            'language_id' => $this->tinyInteger()->unsigned(),
            'name' => $this->string(255)
        ], $tableOptions);


        $this->createIndex('switch', FaqCategory::tableName(), 'switch');
        $this->createIndex('ordern', FaqCategory::tableName(), 'ordern');
        $this->createIndex('user_id', FaqCategory::tableName(), 'user_id');

        $this->createIndex('object_id', FaqCategoryTranslate::tableName(), 'object_id');
        $this->createIndex('language_id', FaqCategoryTranslate::tableName(), 'language_id');

        if ($this->db->driverName != "sqlite") {
            $this->addForeignKey('{{%fk_faq_categories_translate}}', FaqCategoryTranslate::tableName(), 'object_id', FaqCategory::tableName(), 'id', "CASCADE", "NO ACTION");
        }

    }

    public function down()
    {
        if ($this->db->driverName != "sqlite") {
            $this->dropForeignKey('{{%fk_faq_categories_translate}}', FaqCategoryTranslate::tableName());
        }
        $this->dropTable(FaqCategory::tableName());
        $this->dropTable(FaqCategoryTranslate::tableName());
    }

}
