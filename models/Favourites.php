<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favourites".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $contact_id
 *
 * @property Contacts $contact
 * @property User $user
 */
class Favourites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favourites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'contact_id'], 'integer'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['contact_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'contact_id' => 'Contact ID',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return \yii\db\ActiveQuery
     */

    public static function checkFavourite($user_id,$contact_id)
    {
        $contact = self::find()
            ->where([
                'user_id'=>trim($user_id),
                'contact_id'=>trim($contact_id)
            ]);
        if($contact->exists()) {
            return 's';
        }
        return 'r';
    }

    public function getContact()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'contact_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
