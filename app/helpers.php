<?php

function toKeyValueArray(string $value, string $keyName = 'key', string $valueName = 'value')
{
    $firstArray = json_decode($value);
    $secondArray = [];
    foreach ($firstArray as $key => $value) {
        $secondArray[] = [$keyName => $key, $valueName => $value];
    }
    return $secondArray;
}

function fromKeyValueArray(array | string $keyValueArray, string $keyName = 'key', string $valueName = 'value')
{
    if(is_string($keyValueArray)){
        return $keyValueArray;
    }

    $secondArray = [];
    foreach ($keyValueArray as $elem) {
        $secondArray[] = $elem[$keyName];
        $secondArray[] = $elem[$valueName];
    }
    return $secondArray;
}

function decodeTimeTable(string $timetable)
{
    $firstArray = json_decode($timetable);
    $secondArray = [];
    foreach ($firstArray as $day => $schedule) {
        $dayTimetable = ['day' => $day, 'timetable' => []];

        for ($i = 0; $i < count($schedule); $i = $i + 2) {
            $dayTimetable['timetable'][] = [
                'start' => $schedule[$i],
                'end' => $schedule[$i + 1],
            ];
        };

        $secondArray[] = $dayTimetable;
    }
    return $secondArray;
}

function encodeTimeTable(array | string $timetable)
{
    if(is_string($timetable)){
        return $timetable;
    }

    $secondArray = [];
    foreach ($timetable as $dayTimetable) {
        $secondArray[$dayTimetable['day']] = [];

        foreach($dayTimetable['timetable'] as $elem){
            $secondArray[$dayTimetable['day']][]=$elem['start'];
            $secondArray[$dayTimetable['day']][]=$elem['end'];
        }
    }
    return json_encode($secondArray);
}
