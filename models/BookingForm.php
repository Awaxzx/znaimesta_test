<?php

namespace app\models;

class BookingForm extends \yii\base\Model
{
    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['date_from', 'date_to'], 'required'],
            [['date_from', 'date_to'], 'safe'],
            [['date_from', 'date_to'], 'date', 'format' => 'y-m-d'],
            [['date_from', 'date_to'], 'validateDates'],

        ];
    }

    public function validateDates()
    {
        if(strtotime($this->date_from) < strtotime(date('Y-m-d')))
        {
            $this->addError('date_from', 'Начальная дата не может быть в прошлом');
        }

        if (strtotime($this->date_from) > strtotime($this->date_to))
        {
            $this->addError('date_from', 'Укажите правильную начальную и конечную даты');
            $this->addError('date_to', 'Укажите правильную начальную и конечную даты');
        }
    }

    public function attributeLabels()
    {
        return [
            'date_from' => 'Начальная дата',
            'date_to'   => 'Конечная дата',
        ];
    }
}