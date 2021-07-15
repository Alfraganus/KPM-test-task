<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 * @property int|null $is_active
 *
 * @property Favourites[] $favourites
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const ACTIVE=1;
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'number' => 'Number',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */



    public function getFavourites()
    {
        return $this->hasMany(Favourites::className(), ['contact_id' => 'id']);
    }
}
