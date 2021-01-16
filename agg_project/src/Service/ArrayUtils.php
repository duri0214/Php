<?php


namespace App\Service;

class ArrayUtils
{
    /**
     * @param array $records
     * @param array $conditions
     * @return array
     */
    public static function searchArrayByValue(array $records, array $conditions)
    {
        foreach ($conditions as $col => $value) {
            $temp = [];
            foreach (array_keys(array_column($records, $col), $value) as $i) {
                $temp[] = $records[$i];
            }
            $records = $temp;
        }

        return $records;
    }
}
