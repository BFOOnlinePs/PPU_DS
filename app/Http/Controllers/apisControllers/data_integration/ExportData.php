<?php

namespace App\Http\Controllers\apisControllers\data_integration;

use App\Http\Controllers\Controller;
use App\Models\Company;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class ExportData extends Controller
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

        $companies = Company::with(['manager' => function ($query) {
            $query->select('u_id', 'u_username', 'name', 'email', 'u_phone1');
        }])
            ->select('c_id', 'c_name', 'c_english_name', 'c_manager_id')
            ->get();
        // return $companies;


        foreach ($companies as $company) {

            try {
                $response = $http->post('https://api-core.ppu.edu/api/DualStudies/Company/Add', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . session('auth_token'),
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
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

                return $response->getBody()->getContents();
            } catch (ClientException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong. Please try again.',
                    'error' => $responseBodyAsString
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong. Please try again.',
                ], 500);
            }
        }
    }
}
