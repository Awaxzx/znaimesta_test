<?php

/**
 * @var $this yii\web\View
 * @var $bookingForm \app\models\BookingForm
 * @var $bookingListHtml string
 */

use kartik\date\DatePicker;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12" id="booking">
                <h1>Бронирование</h1>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'js-form']]); ?>
                <div class="form-group">
                    <?= DatePicker::widget([
                        'form'          => $form,
                        'model'         => $bookingForm,
                        'attribute'     => 'date_from',
                        'value'         => date('Y-m-d'),
                        'type'          => DatePicker::TYPE_RANGE,
                        'attribute2'    => 'date_to',
                        'value2'        => date('Y-m-d', strtotime('+1 month', time())),
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'format'         => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            'todayBtn'       => true
                        ]
                    ]); ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Найти номера', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
                <div id="rooms">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="bookingList">
                <?= $bookingListHtml ?>
            </div>
        </div>
    </div>
</div>
