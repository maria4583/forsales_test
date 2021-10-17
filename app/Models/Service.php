<?php

namespace App\Models;

use Core\Database\Model;

class Service extends Model
{
    public function tableName(): string
    {
        return 'services';
    }

    public function fields(): array
    {
        return [];
    }

    /**
     * Generate a report of all services
     *
     * @param $startDate
     * @param $endDate
     * @param $clientType
     * @return array
     */
    public function makeReport($startDate, $endDate, $clientType): array
    {
        $sql = "
             SELECT
                 s.name AS 'service_name',
                 (
                     SELECT SUM(sum)
                     FROM payments
                     WHERE date <= :startDate AND service_id = s.id
                 ) as 'start_balance',
                 SUM(CASE WHEN p.sum > 0 THEN p.sum ELSE 0 END) AS 'receipt',
                 SUM(CASE WHEN p.sum < 0 THEN p.sum ELSE 0 END) AS 'expense',
                 SUM(CASE WHEN pt.name = 'Перерасчет' THEN p.sum ELSE 0 END) AS 'recalculate',
                 (
                     SELECT SUM(sum)
                     FROM payments
                     WHERE date <= :endDate AND service_id = s.id
                 ) as 'end_balance'
             FROM services s
                 INNER JOIN payments p ON s.id = p.service_id
                 INNER JOIN clients c ON p.client_id = c.id
                 INNER JOIN payment_types pt ON p.payment_type_id = pt.id
             WHERE p.date BETWEEN :startDate AND :endDate
             AND (IF(:clientType IS NOT NULL, c.type = :clientType, 1))
             GROUP BY s.name
         ";

        $result = $this->sql($sql, [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'clientType' => $clientType
        ]);

        return $result;
    }
}
