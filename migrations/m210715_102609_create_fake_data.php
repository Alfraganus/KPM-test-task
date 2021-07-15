<?php

use app\models\Contacts;
use Faker\Factory;
use yii\db\Migration;

/**
 * Class m210715_102609_create_fake_data
 */
class m210715_102609_create_fake_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i=0;$i<20;$i++) {
            $faker = Factory::create();
            $model = new Contacts();
            $model->name = $faker->name;
            $model->number = $faker->phoneNumber;
            $model->save(false);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       Contacts::deleteAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210715_102609_create_fake_data cannot be reverted.\n";

        return false;
    }
    */
}
