<?php


function currentTime()
{
    $date = new DateTime();
    $date->setTimeZone(new DateTimeZone("asia/kolkata"));
    $get_datetime = $date->format('H:i');
    return  $get_datetime;
}


function currentDate()
{
    return  date('Y-m-d');
}

function getBadgeClass($statusName)
{
    $map = [
        'New Lead' => 'b-new',
        'Follow Up' => 'b-fu',
        'Call Back' => 'b-cb',
        'Proceed to QC' => 'b-qc',
        'Order Confirmed' => 'b-success',
        'Closed Lost' => 'b-danger',
        'Qualified' => 'b-qualified',
        'Not Qualified' => 'b-not-qualified',
        'ERP Approved' => 'b-erp',
        'Payment Done' => 'b-payment',
        'Quotation Sent' => 'b-quotation',
        'Rejected' => 'b-rejected',
    ];

    return $map[$statusName] ?? 'b-new';
}

function dateSave($date)
{
    return date('Y-m-d', strtotime($date));
}
function timeSave($date)
{
    return date('H:i:s', strtotime($date));
}

function dateShow($date)
{
    return date('d-M-Y', strtotime($date));
}
function orderDateShow($date)
{
    return date('Y-m-d', strtotime($date));
}
function timeShow($time)
{
    return date('h:i:s a', strtotime($time));
}
