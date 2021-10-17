<?php

namespace App\Controllers;

use Core\Routing\{Controller, Request, Response};
use App\Models\Service;

class ReportController extends Controller
{
    /**
     * Validates request params and return report as JSON
     *
     * @param Request $request
     * @param Response $response
     */
    public function index(Request $request, Response $response)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'client_type' => 'equal:1,2'
        ]);

        if ($request->getErrors()) {
            return $response->toJson([
                'errors' => $request->getErrors()
            ]);
        }

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $clientType = $request->client_type;

        $serviceModel = new Service();
        $result = $serviceModel->makeReport(
            $startDate,
            $endDate,
            $clientType === '1' || $clientType === '2' ? $clientType : null
        );

        return $response->toJson($result);
    }
}
