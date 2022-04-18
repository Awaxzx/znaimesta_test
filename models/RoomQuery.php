<?php

namespace app\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Room]].
 *
 * @see Room
 */
class RoomQuery extends \yii\db\ActiveQuery
{
    public function consideringBooking($date_from, $date_to)
    {
        return $this->andWhere(new Expression('(SELECT count(id) FROM booking WHERE room_id = rooms.id AND 
        (date_from BETWEEN CAST(:date_from AS DATE) AND CAST(:date_to AS DATE) 
	    OR (date_to BETWEEN CAST(:date_from AS DATE) AND CAST(:date_to AS DATE))
	    )) < rooms.quota',
                [':date_from' => $date_from, ':date_to' => $date_to])
        );
    }

    /**
     * {@inheritdoc}
     * @return Room[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Room|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
