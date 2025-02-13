<?php

namespace App\Http\Controllers\project\settings;

use App\Http\Controllers\Controller;
use App\Models\Company;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExportDataController extends Controller
{
    public function exportCompanies()
    {
        $http = new \GuzzleHttp\Client();

        /*
            {
                "success": false,
                "data": null,
                "msgCode": "REQUEST_FAILED",
                "traceID": "6f3581b7-9786-4340-9038-5655132c0399",
                "exception": "ldap_add(): Add: Already exists"
            }
        */


        /*
            {
                "success": true,
                "data": {
                    "has_error": [],
                    "message": []
                },
                "msgCode": null,
                "traceID": null,
                "exception": null
            }
        */

        $successCount = 0;
        $failureCount = 0;
        $errors = [];

        $companies = Company::with(['manager' => function ($query) {
            $query->select('u_id', 'u_username', 'name', 'email', 'u_phone1');
        }])
            ->select('c_id', 'c_name', 'c_english_name', 'c_manager_id')
            ->get();

        foreach ($companies as $company) {
            Log::info('token: ' . session('auth_token'));

            try {
                $response = $http->post('https://api-core.ppu.edu/api/DualStudies/Company/Add', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . session('auth_token'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'caName' => $company->c_name,
                        'ceName' => $company->c_english_name,
                        'cpaName' => $company->manager->name,
                        'cpeName' => $company->manager->name,
                        'email2' => $company->manager->email,
                        'mobile' => $company->manager->u_phone1,
                        'pw' => $company->manager->u_phone1,
                        'userName' => $company->manager->u_phone1,
                    ]
                ]);

                $responseData = json_decode($response->getBody()->getContents(), true);

                if (isset($responseData['success']) && $responseData['success'] === true) {
                    $successCount++;
                } else {
                    $failureCount++;
                    $errors[] = [
                        'company_id' => $company->c_id,
                        'company_name' => $company->c_name,
                        'error' => 'API response indicated failure'
                    ];
                }
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                $failureCount++;
                $errors[] = [
                    'company_id' => $company->c_id,
                    'company_name' => $company->c_name,
                    'error' => $responseBodyAsString
                ];
            } catch (\Exception $e) {
                $failureCount++;
                $errors[] = [
                    'company_id' => $company->c_id,
                    'company_name' => $company->c_name,
                    'error' => $e->getMessage()
                ];
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Companies exported successfully',
            'success_count' => $successCount,
            'failure_count' => $failureCount,
            'errors' => $errors
        ]);
    }
}
