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
