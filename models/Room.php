<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $quota
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Booking[] $bookings
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quota', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'name'       => 'Name',
            'quota'      => 'Quota',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::class, ['room_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomQuery(get_called_class());
    }
}
