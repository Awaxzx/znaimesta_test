<?php
/**
 * @var $booking \app\models\Booking
 */

use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model'      => $booking,
    'attributes' => [
        [
            'attribute' => 'room_id',
            'value'     => function ($model) {
                return $model->getRoomName();
            },
        ],
        'date_from:date',
        'date_to:date',
        'name',
        'email',
        'created_at:datetime',
    ],
]) ?>
