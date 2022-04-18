<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $room_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $date_from
 * @property string|null $date_to
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Room $room
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'date_from', 'date_to', 'name', 'email'], 'required'],
            [['room_id', 'created_at', 'updated_at'], 'integer'],
            [['date_from', 'date_to'], 'safe'],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 255],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'room_id'    => 'Номер',
            'name'       => 'ФИО',
            'email'      => 'Email',
            'date_from'  => 'Дата начала',
            'date_to'    => 'Дата окончания',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'room_id']);
    }

    public function getRoomName()
    {
        if ($this->room)
        {
            return $this->room->name;
        }
    }
}
