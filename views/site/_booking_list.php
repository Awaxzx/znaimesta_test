<?php
/**
 * @var $booking \app\models\Booking[]
 * @var $roomsQuotas \app\models\Room[]
 */
?>
<?php if ($booking): ?>
    <h2>История бронирования</h2>
    <table class="table table-condensed">
        <tr>
            <th>Номер</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
        </tr>
        <?php foreach ($booking as $row): ?>
            <tr>
                <td><?= $row->getRoomName() ?></td>
                <td><?= $row->date_from ?></td>
                <td><?= $row->date_to ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<?php if ($roomsQuotas): ?>
    <h2>Квоты номеров</h2>
    <table class="table table-condensed">
        <tr>
            <th>Номер</th>
            <th>Квота</th>
        </tr>
        <?php foreach ($roomsQuotas as $room): ?>
            <tr>
                <td><?= $room->name ?></td>
                <td><?= $room->quota ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
