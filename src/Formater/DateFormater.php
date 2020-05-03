<?php

namespace Formater;

class DateFormater implements FormaterInterface
{
    const FORMAT_DATE = "yyyy-mm-dd";
    const FORMAT_TIME = "hh:mm:ss";
    const FORMAT_DATETIME = "yyyy-mm-dd hh:mm:ss";

    public function format(string $date, string $type)
    {
        return $this->getDate($date, $type);

    }

    private function getDate(string $date, string $type)
    {
        switch ($type) {
            case static::FORMAT_DATE:
                return date(static::FORMAT_DATE, strtotime(trim($date)));
                break;
            case static::FORMAT_DATETIME:
                return date(static::FORMAT_DATETIME, strtotime(trim($date)));
                break;
            case static::FORMAT_TIME:
                return date(static::FORMAT_TIME, strtotime(trim($date)));
                break;
            default:
                return date(static::FORMAT_DATETIME, strtotime(trim($date)));
        }
    }
}
