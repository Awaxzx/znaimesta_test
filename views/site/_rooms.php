<?php
/**
 * @var $rooms \app\models\Room[]
 * @var $booking \app\models\Booking
 */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<?php if ($rooms): ?>
    <?php $form = ActiveForm::begin(['options' => ['class' => 'js-booking']]); ?>
    <ul>
        <?php foreach ($rooms as $key => $room): ?>
            <li>
                <?= Html::radio("Booking[room_id]", $key == 0, ['label' => false, 'id' => 'room_' . $room->id, 'value' => $room->id]) ?>
                <label for="room_<?= $room->id ?>"><?= $room->name ?></label>
            </li>
        <?php endforeach; ?>
    </ul>
    <?= $form->field($booking, 'name')->textInput() ?>
    <?= $form->field($booking, 'email')->textInput(['type' => 'email']) ?>
    <?= Html::activeHiddenInput($booking, 'date_from') ?>
    <?= Html::activeHiddenInput($booking, 'date_to') ?>
    <div class="form-group">
        <?= Html::submitButton('Забронировать', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>