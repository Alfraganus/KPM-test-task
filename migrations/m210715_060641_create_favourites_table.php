<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favourites}}`.
 */
class m210715_060641_create_favourites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favourites}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'contact_id' => $this->integer()->null(),
        ]);

        $this->addForeignKey(
            'fk-favourites-user_id',
            'favourites',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-favourites-contact_id',
            'favourites',
            'contact_id',
            'contacts',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-favourites-user_id',
            'favourites',
            'user_id'
        );

        $this->createIndex(
            'idx-favourites-contact_id',
            'favourites',
            'contact_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-favourites-user_id',
            'favourites'
        );
        $this->dropForeignKey(
            'fk-favourites-contact_id',
            'favourites'
        );

        $this->dropIndex(
            'idx-favourites-user_id',
            'favourites'
        );
        $this->dropIndex(
            'idx-favourites-contact_id',
            'favourites'
        );
        $this->dropTable('{{%favourites}}');
    }
}
