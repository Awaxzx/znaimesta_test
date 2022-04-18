<?php

namespace app\controllers;

use app\models\Booking;
use app\models\BookingForm;
use app\models\Room;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $bookingForm = new BookingForm();

        return $this->render('index', [
            'bookingForm'     => $bookingForm,
            'bookingListHtml' => $this->getBookingListHtml(),]);
    }

    public function actionSearch()
    {
        if (!Yii::$app->request->isAjax)
        {
            throw new HttpException('404');
        }

        $bookingForm = new BookingForm();
        if ($bookingForm->load(\Yii::$app->request->post()) && $bookingForm->validate())
        {
            $rooms = Room::find()->consideringBooking($bookingForm->date_from, $bookingForm->date_to)->all();
        }

        if ($rooms)
        {
            $booking            = new Booking();
            $booking->date_from = $bookingForm->date_from;
            $booking->date_to   = $bookingForm->date_to;
            return $this->asJson(['status'          => 'ok',
                                  'roomsHtml'       => $this->renderPartial('_rooms', [
                                      'rooms'   => $rooms,
                                      'booking' => $booking
                                  ]),
                                  'bookingListHtml' => $this->getBookingListHtml(),
            ]);
        }

        return $this->asJson(['status'  => 'error',
                              'message' => 'Номеров нет!']);

    }


    public function actionBooking()
    {
        if (!Yii::$app->request->isAjax)
        {
            throw new HttpException('404');
        }

        $booking = new Booking();
        if ($booking->load(\Yii::$app->request->post()) && $booking->validate())
        {
            $booking->save(false);
            return $this->asJson(['status'          => 'ok',
                                  'summaryHtml'     => $this->renderPartial('_summary', ['booking' => $booking]),
                                  'bookingListHtml' => $this->getBookingListHtml(),
            ]);
        }
        else
        {
            return $this->asJson(['status' => 'error',
                                  'errors' => $booking->getErrors()]);
        }
    }

    private function getBookingListHtml()
    {
        $bookingList = Booking::find()->orderBy('room_id')->all();
        $roomsQuotas = Room::find()->all();
        return $this->renderPartial('_booking_list', ['booking' => $bookingList, 'roomsQuotas' => $roomsQuotas]);
    }
}
