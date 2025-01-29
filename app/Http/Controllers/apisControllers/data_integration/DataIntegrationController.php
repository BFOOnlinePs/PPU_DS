<?php

namespace App\Http\Controllers\apisControllers\data_integration;

use App\Http\Controllers\Controller;
use App\Models\CitiesModel;
use App\Models\Major;
use App\Services\CustomIdentityServerProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataIntegrationController extends Controller
{
    protected $customIdentityServerProvider;

    public function __construct(CustomIdentityServerProvider $customIdentityServerProvider)
    {
        $this->customIdentityServerProvider = $customIdentityServerProvider;
    }


    public function syncMajors()
    {
        $accessToken = request()->query('access_token');

        $majors = $this->customIdentityServerProvider->getMajors($accessToken);
        Log::info('syncMajors:' . $majors);
        $majors = $majors['data'];

        foreach ($majors as $major) {
            $major = Major::updateOrCreate(
                ['m_id' => $major['majorNo']], // Condition to find existing record
                [
                    'm_reference_code' => $major['majorNo'],
                    'm_name' => $major['majorArabicName']
                ] // Values to update or insert
            );
        }

        return response()->json(['message' => 'Majors synced successfully']);
    }


    public function syncCities()
    {
        $accessToken = request()->query('access_token');

        $cities = $this->customIdentityServerProvider->getAllCities($accessToken);
        Log::info('syncCities:' . $cities);
        $cities = $cities['data'];

        foreach ($cities as $city) {
            $city = CitiesModel::updateOrCreate(
                ['id' => $city['rid']],
                [
                    'city_name_ar' => $city['raname'],
                    'city_name_en' => $city['raname']
                ]
            );
        }

        return response()->json(['message' => 'Cities synced successfully']);
    }


}
