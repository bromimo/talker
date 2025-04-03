<?php

namespace core\Journal;

class Journal
{
    public static function getUserNextRecords(string $userPhone): array
    {
        $res = q("SELECT tor.record, r.time, r.data, s.firstName, s.lastName, r.user 
                        FROM records r 
                            JOIN type_of_records tor ON tor.id = r.record 
                            JOIN users u ON u.id = r.user 
                            JOIN subjects s ON u.subject = s.id 
                            JOIN phones p ON p.subject = r.subject 
                        WHERE p.phone = ? 
                            AND r.data >= CURRENT_DATE() 
                            AND r.deleted = 0", [$userPhone], true);

        return $res;
    }
}