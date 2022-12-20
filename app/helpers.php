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

function fromKeyValueArray(array $keyValueArray, string $keyName = 'key', string $valueName = 'value')
{
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

function encodeTimeTable(array $timetable)
{
    $secondArray = [];
    foreach ($timetable as $dayTimetable) {
        $secondArray[$dayTimetable['day']] = [];

        foreach($dayTimetable['day'] as $elem){
            $secondArray[$dayTimetable['day']][]=$elem['start'];
            $secondArray[$dayTimetable['day']][]=$elem['end'];
        }
    }
    return json_encode($secondArray);
}
