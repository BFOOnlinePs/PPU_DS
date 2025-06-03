<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use App\Models\CitiesModel;
use App\Models\Major;
use App\Models\StudentCompanyNominationModel;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompaniesCategory;
use App\Models\User;
use App\Models\CompanyBranch;
use App\Models\CompanyDepartment;
use App\Models\companyBranchDepartments;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class CompaniesController extends Controller
{
    //
    public function index()
    {
        $majors = Major::get();
        $data = Company::with('manager', 'companyCategories')->get();
        $uncompletedCompany = Company::with('manager')->where('c_type', null)->get();
        return view('project.admin.companies.index', ['data' => $data, 'majors' => $majors, 'uncompletedCompany' => $uncompletedCompany]);
    }

    //add new company page
    public function company(Request $request)
    {
        ////////////////////////////TO DOOOOOO//////////////////////////////////////
        //check if there is company without data return it here
        //and in index page put popup that has link to continue editing this company
        ////////////////////////////////////////////////////////////////////////////

        $uncompletedCompany = Company::with('manager')->where('c_type', null)->get();
        //$uncompletedCompany = json_encode($uncompletedCompany, true);

        //return count($nonCompletedCompany);
        $cities = CitiesModel::get();
        $categories = CompaniesCategory::get();
        return view('project.admin.companies.company', ['categories' => $categories, 'uncompletedCompany' => $uncompletedCompany, 'cities' => $cities]);
    }

    public function create(Request $request)
    {
        $http = new \GuzzleHttp\Client();

        try {
            // 1. حفظ المستخدم محليًا
            $user = new User();
            $user->u_username = $request->mobile;
            $user->name = $request->user;
            $user->email = $request->email2;
            $user->password = Hash::make($request->mobile);
            $user->u_phone1 = $request->mobile;
            $user->u_address = $request->address;
            $user->u_role_id = 6;
            $user->u_date_of_birth = Carbon::parse('01/01/1990');
            $user->u_tawjihi_gpa = 0;

            $check_phone=User::where('u_phone1',$request->mobile)->first();
            if($check_phone){
                return response()->json([
                    'success' => 'false',
                    'message' => 'رقم الهاتف هذا مسجل مسبقا للمستخدم ' . $check_phone->name . 'والمرتبط بالشركة ' . $check_phone->company->c_name
                ]);
            }
            
            $user->save();

            // 2. حفظ الشركة محليًا
            $company = new Company();
            $company->c_name = $request->caName;
            $company->c_english_name = $request->ceName;
            $company->c_manager_id = $user->u_id;
            $company->c_status = 1;
            $company->save();

            // 3. حفظ الفرع
            $branch = new CompanyBranch();
            $branch->b_company_id = $company->c_id;
            $branch->b_address = 'لا يوجد عنوان';
            $branch->b_phone1 = $request->mobile;
            $branch->b_manager_id = $user->u_id;
            $branch->b_city_id = $request->b_city_id;
            $branch->b_main_branch = 1;
            $branch->save();

            $response = $http->post('https://api-core.ppu.edu/api/DualStudies/Company/Add', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('auth_token'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'caName' => $request->caName,
                    'ceName' => $request->ceName,
                    'cpaName' => $request->caName,
                    'cpeName' => $request->ceName,
                    'email2' => $request->email2,
                    'mobile' => $request->mobile,
                    'pw' => $request->mobile,
                    'userName' => $request->mobile,
                ]
            ]);

            $responseData = json_decode($response->getBody(), true);

            if (!isset($responseData['success']) || !$responseData['success']) {
                return $responseData;
            }

            return redirect()->back()->with('success', 'تم إضافة الشركة محليًا وخارجيًا بنجاح');
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return $response;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $uncompletedCompany = Company::with('manager')->where('c_type', null)->get();
        $categories = CompaniesCategory::get();
        $data = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $id)->first();
        // $companyDepartments=CompanyBranch::with('companyDepartments')->where('b_company_id',$id)->get();
        $companyDepartments = CompanyDepartment::where('d_company_id', $id)->get();

        //return $data;
        return view('project.admin.companies.edit', ['company' => $data, 'categories' => $categories, 'uncompletedCompany' => $uncompletedCompany, 'companyDepartments' => $companyDepartments]);
    }

    public function edit2($id)
    {
        $company = Company::where('c_id', $id)->first();
        $data = User::where('u_id', $company->c_manager_id)->first();
        $company_branch = CompanyBranch::where('b_company_id', $id)->where('b_main_branch', 1)->first();
        // $companyDepartments=CompanyBranch::with('companyDepartments')->where('b_company_id',$id)->get();
        return view('project.admin.companies.edit2', ['user' => $data, 'company' => $company, 'company_branch' => $company_branch]);
    }

    //this function for update inserted company in add company page
    public function updateCompany(Request $request)
    {

        $data = Company::where('c_manager_id', $request->manager_id)->first();
        if ($request->c_description != null) {
            $data->c_description = $request->c_description;
        }
        if ($request->c_website != null) {
            $data->c_website = $request->c_website;
        }
        $data->c_type = $request->c_type;
        $data->c_category_id = $request->c_category;

        if ($data->save()) {
            return response()->json([
                'success' => 'true',
                'data' => "all has done"
            ]);
        }

        // return response()->json([
        //     'success'=>'true',
        //     'data'=>"all has done"
        // ]);
    }
    public function update(Request $request)
    {

        $user = User::where('u_id', $request->manager_id)->first();
        $user->u_username = $request->email;
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->u_phone1 = $request->phoneNum;
        $user->u_address = $request->address;

        $company = Company::where('c_id', $request->c_id)->first();
        $companyMainBranch = CompanyBranch::where('b_company_id', $request->c_id)->where('b_main_branch', 1)->first();
        $companyMainBranch->b_phone1 = $request->phoneNum;
        $companyMainBranch->b_address = $request->address;
        $company->c_type = $request->c_type;
        $company->c_name = $request->c_name;
        $company->c_category_id = $request->c_category;
        $company->c_description = $request->c_description;
        $company->c_website = $request->c_website;

        if ($user->save() && $company->save() && $companyMainBranch->save()) {
            $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->c_id)->first();
            $categories = CompaniesCategory::get();
            $companyDepartments = CompanyDepartment::where('d_company_id', $request->c_id)->get();
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.companyInfoForm', ['company' => $company, 'categories' => $categories, 'companyDepartments', $companyDepartments])->render(),
                'branchView' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()
            ]);
        }
    }

    public function update2(Request $request)
    {
        $http = new \GuzzleHttp\Client();
        try {
            
            $phone_check = User::where('u_phone1', $request->mobile)->first();
            // if ($phone_check) {
            //     return response()->json([
            //         'success' => 'false',
            //         'message' => 'رقم الهاتف هذا مسجل مسبقا للمستخدم ' . $phone_check->name . 'والمرتبط بالشركة ' . $phone_check->company->c_name
            //     ]);
            // }

            // 1. تحديث بيانات المستخدم
            $user = User::where('u_id', $request->company_id)->firstOrFail();
            $user->u_username = $request->mobile;
            $user->name = $request->caName;
            $user->email = $request->email2;
            $user->u_phone1 = $request->mobile;

            $check_phone=User::where('u_phone1',$request->mobile)->where('u_id','!=',$user->u_id)->first();
            if($request->mobile == $check_phone->u_phone1){
                return response()->json([
                    'success' => 'false',
                    'message' => 'رقم الهاتف هذا مسجل مسبقا للمستخدم ' . $check_phone->name . 'والمرتبط بالشركة ' . $check_phone->company->c_name
                ]);
            }

            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            // 2. تحديث بيانات الشركة
            $company = Company::where('c_manager_id', $user->u_id)->first();
            if ($company) {
                $company->c_name = $request->caName;
                $company->c_english_name = $request->ceName;
                $company->save();
            }

            // 3. تحديث بيانات الفرع
            $branch = CompanyBranch::where('b_company_id', $company->c_id)->first();
            if ($branch) {
                $branch->b_phone1 = $request->mobile;
                // $branch->b_city_id = $request->b_city_id;
                $branch->save();
            }

            // 4. إرسال البيانات إلى الـ API الخارجي
            $response = $http->post('https://api-core.ppu.edu/api/DualStudies/Company/Add', [
                'headers' => [
                    'Authorization' => 'Bearer ' . session('auth_token'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'caName' => $request->caName,
                    'ceName' => $request->ceName ?? $request->caName,
                    'cpaName' => $request->caName,
                    'cpeName' => $request->ceName ?? $request->caName,
                    'email2' => $request->email2,
                    'mobile' => $request->mobile,
                    'pw' => $request->mobile,
                    'userName' => $request->mobile,
                ]
            ]);
            return 'mohaamd';
            $responseData = json_decode($response->getBody(), true);

            if (!isset($responseData['success']) || !$responseData['success']) {
                return redirect()->back()->with('error', 'حدث خطأ: ' . $responseData['message']);
            }

            return redirect()->back()->with('success',  'تم التعديل بنجاح');
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            return $responseBody;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function updateDepartments(Request $request)
    {
        $companyDepartments = CompanyDepartment::where('d_company_id', $request->c_id)->get();
        foreach ($companyDepartments as $key) {
            // for($i = 0 ; $i<count($companyDepartments) ; $i++){
            $d_name = 'd_name_' . $key->d_id;

            $companyDepartment = CompanyDepartment::where('d_id', $key->d_id)->first();
            $companyDepartment->d_name = $request->$d_name;
            $companyDepartment->save();
        }

        // foreach($companyDepartments as $x){
        //     $companyDepartment=CompanyDepartment::where('d_id',$x->d_id)->first();
        //     $companyDepartment->d_name = $request->d_name_

        // }

        if ($companyDepartment->save()) {
            $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->c_id)->first();
            $categories = CompaniesCategory::get();
            $companyDepartments = CompanyDepartment::where('d_company_id', $request->c_id)->get();
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.departmentForm', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render(),
                'branchView' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()
            ]);
        }
    }
    //reem
    public function createBranches(Request $request)
    {

        $newlyCreatedId = 0;
        $departmentsList = json_decode($request->departmentsList, true);
        $company_id = Company::where('c_manager_id', $request->manager_id)->first()->c_id;



        for ($i = 1; $i <= $request->branchesNum; $i++) {
            if ($i == 1) {
                $data = CompanyBranch::where('b_company_id', $company_id)->first();
                $phone2 = 'phone2_' . $i;
                if ($request->$phone2 != null) {
                    $data->b_phone2 = $request->$phone2;
                }
            } else {
                $data = new CompanyBranch;
                $data->b_company_id = $company_id;
                $address = 'address' . $i;
                $data->b_address = $request->$address;
                $phone1 = 'phone1_' . $i;
                $data->b_phone1 = $request->$phone1;
                $phone2 = 'phone2_' . $i;
                if ($request->$phone2 != null) {
                    $data->b_phone2 = $request->$phone2;
                }
                $data->b_main_branch = 0;
                $data->b_manager_id = $request->manager_id;
            }

            if ($data->save()) {
                $departments = 'department_for_' . $i;
                if ($request->$departments != null) {

                    $newlyCreatedId = $data->b_id;
                    $branchDepartments = json_decode($request->$departments, true);
                    for ($r = 0; $r < count($branchDepartments); $r++) {
                        $branchDepartment = new companyBranchDepartments;
                        $branchDepartment->cbd_company_branch_id = $newlyCreatedId;


                        ///to get department name///////////////////
                        $departmentName = $branchDepartments[$r];
                        $departmentName = $departmentsList[$departmentName];
                        ////////////////////////////////////////////

                        $depID = CompanyDepartment::where('d_company_id', $company_id)
                            ->where('d_name', $departmentName)->first()->d_id;

                        $branchDepartment->cbd_d_id = $depID;

                        $branchDepartment->save();
                    }
                }
            }
        }



        return response()->json([
            'success' => 'true',
        ]);
    }

    //noor
    public function createBranchesEdit(Request $request)
    {


        $departmentsList = json_decode($request->departmentsList);

        // $company_id=Company::where('c_id',$request->c_id)->first();
        $mainBranch = CompanyBranch::where('b_company_id', $request->c_id)->where('b_main_branch', 1)->first();
        $x = $request->phone2 != null;

        $data = new CompanyBranch;

        $data->b_company_id = $request->c_id;
        $data->b_address = $request->address;
        $data->b_phone1 = $request->phone1;
        if ($x == 1) {
            $data->b_phone2 = $request->phone2;
        }
        $data->b_manager_id = $request->manager_id;
        if ($mainBranch) {
            $data->b_main_branch = 0;
        } else {
            $data->b_main_branch = 1;
        }




        if ($data->save()) {
            for ($i = 0; $i < count($departmentsList); $i++) {
                $companyBranchDepartments = new companyBranchDepartments;
                $companyBranchDepartments->cbd_company_branch_id = $data->b_id;
                $companyBranchDepartments->cbd_d_id = $departmentsList[$i];
                $companyBranchDepartments->save();
            }
            $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->c_id)->first();
            $categories = CompaniesCategory::get();
            $companyDepartments = CompanyDepartment::where('d_company_id', $request->c_id)->get();
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()
            ]);
        }
    }


    //noor
    public function updateBranches(Request $request)
    {
        $departmentSelectedListName = "departmentSelectedList_" . $request->b_id;
        $departmentSelectedList = json_decode($request->$departmentSelectedListName, true);
        $existDepartmentList1 = companyBranchDepartments::where('cbd_company_branch_id', $request->b_id)->pluck('cbd_d_id')->toArray();
        $existDepartmentList = companyBranchDepartments::where('cbd_company_branch_id', $request->b_id)->get();
        $collection1 = collect($departmentSelectedList);
        $collection2 = collect($existDepartmentList1);
        $commonItems = $collection1->intersect($collection2)->values()->all();
        $uniqueCollection1 = $collection1->diff($collection2)->values()->all();
        $uniqueCollection2 = $collection2->diff($collection1)->values()->all();
        if (count($collection1) == count($collection2)) {
            for ($i = 0; $i < count($uniqueCollection1); $i++) {
                if ($uniqueCollection1[$i] != $existDepartmentList1[$i]) {
                    $existDepartmentList[$i]->cbd_d_id = $uniqueCollection1[$i];
                    $existDepartmentList[$i]->save();
                }
            }
        } else {
            if (count($existDepartmentList) == 0) {

                for ($i = 0; $i < count($departmentSelectedList); $i++) {
                    $branchDepartments = new companyBranchDepartments;
                    $branchDepartments->cbd_company_branch_id = $request->b_id;
                    $branchDepartments->cbd_d_id = $departmentSelectedList[$i];
                    $branchDepartments->save();
                }
            } else {
                for ($i = 0; $i < count($uniqueCollection1); $i++) {
                    $branchDepartments = new companyBranchDepartments;
                    $branchDepartments->cbd_d_id = $uniqueCollection1[$i];
                    $branchDepartments->cbd_company_branch_id = $request->b_id;
                    $branchDepartments->save();
                }
                for ($j = 0; $j < count($uniqueCollection2); $j++) {
                    $branchDepartmentForDelete = companyBranchDepartments::where('cbd_company_branch_id', $request->b_id)
                        ->where('cbd_d_id', $uniqueCollection2[$j])
                        ->get();

                    $branchDepartmentForDelete[$i]->delete();
                }
            }
        }

        $data = CompanyBranch::where('b_id', $request->b_id)->first();
        $address = 'address_' . $request->b_id;
        $phone1 = 'phone1_' . $request->b_id;
        $phone2 = 'phone2_' . $request->b_id;
        $manager_id = 'manager_id_' . $request->b_id;
        $c_id = 'c_id_' . $request->b_id;
        $x = $request->$phone2 != null;
        $data->b_address = $request->$address;
        $data->b_phone1 = $request->$phone1;
        if ($x == 1) {
            $data->b_phone2 = $request->$phone2;
        }
        $data->b_manager_id = $request->$manager_id;
        if ($data->b_main_branch == 1) {
            $companyMainBranch = User::where('u_id', $request->$manager_id)->first();
            $companyMainBranch->u_phone1 = $request->$phone1;
            $companyMainBranch->u_address = $request->$address;
        }
        if ($data->save() && $companyMainBranch->save()) {
            $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->$c_id)->first();
            $categories = CompaniesCategory::get();
            $companyDepartments = CompanyDepartment::where('d_company_id', $request->$c_id)->get();
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render(),
                'companyInfoView' => view('project.admin.companies.ajax.companyInfoForm', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()

            ]);
        }
    }

    //noor
    public function addDepartment(Request $request)
    {
        $data = new CompanyDepartment;
        $data->d_name = $request->d_name;
        $data->d_company_id = $request->d_company_id; //must be  d_company_id until change the attribute in DB and reems' Tasks

        if ($data->save()) {
            $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->d_company_id)->first();
            $categories = CompaniesCategory::get();
            $companyDepartments = CompanyDepartment::where('d_company_id', $request->d_company_id)->get();
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.departmentForm', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render(),
                'branchView' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()

            ]);
        }
    }


    //reem
    public function checkCompany(Request $request)
    {

        $data = Company::where('c_name', $request->search)->first();

        if ($data != null) {

            $company_id = $data->c_id;
            $company_name = $data->c_name;

            return response()->json([
                'success' => 'true',
                'company_id' => $company_id,
                'company_name' => $company_name,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => 'true',
                'data' => $data
            ]);
        }
    }

    //reem
    public function companySearch(Request $request)
    {
        $data = Company::with('manager', 'companyCategories')->where('c_name', 'like', '%' . $request->search . '%')->get();

        if ($data->count() > 0) {
            return response()->json([
                'success' => 'true',
                'view' => view('project.admin.companies.ajax.companyList', ['data' => $data])->render()
            ]);
        } else {
            return response()->json([
                'success' => 'false',
                'view' => view('project.admin.companies.ajax.companyList', ['data' => $data])->render()
            ]);
        }
    }

    //reem
    public function createDepartments(Request $request)
    {
        $companyDepartments = json_decode($request->departments, true);
        for ($r = 0; $r < count($companyDepartments); $r++) {
            $department = new CompanyDepartment;
            $department->d_name = $companyDepartments[$r];
            $department->d_company_id = $request->companyID;
            $department->save();
        }
        return response()->json([
            'success' => 'true'
        ]);
    }

    public function checkEmailEdit(Request $request)
    {
        $user_email = User::where('email', $request->email)->first();
        if ($user_email && ($user_email->email != $request->existEmail)) {
            // if($user_email) {
            return response()->json([
                'status' => 'true'
            ]);
        } else {
            return response()->json(['status' => 'false']);
        }
    }



    public function branch(Request $request)
    {

        $company = Company::with('manager', 'companyCategories', 'companyBranch.companyBranchDepartments.departments', 'companyDepartments')->where('c_id', $request->c_id)->first();
        $categories = CompaniesCategory::get();
        $companyDepartments = CompanyDepartment::where('d_company_id', $request->c_id)->get();
        return response()->json([
            'success' => 'true',
            'view' => view('project.admin.companies.ajax.companyBranches', ['company' => $company, 'categories' => $categories, 'companyDepartments' => $companyDepartments])->render()

        ]);
    }

    public function search_student_ajax(Request $request)
    {
        $data = User::where('u_role_id', 2)
            ->whereNotIn('u_id', function ($query) {
                $query->select('scn_student_id')
                    ->from('student_company_nomination');
            })
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search_student . '%')
                    ->orWhere('u_major_id', $request->major_id)
                    ->orWhere('u_username', 'like', '%' . $request->search_student . '%');
            })
            ->when($request->filled('major_id'), function ($query) use ($request) {
                $query->where('u_major_id', $request->major_id);
            })
            ->get();
        return response()->json([
            'success' => 'true',
            'view' => view('project.admin.companies.ajax.searchStudents', ['data' => $data])->render()
        ]);
    }

    public function student_nomination_table_ajax(Request $request)
    {
        $data = StudentCompanyNominationModel::where('scn_company_id', $request->company_id)->get();
        foreach ($data as $key) {
            $key->student = User::where('u_id', $key->scn_student_id)->first();
        }
        return response()->json([
            'success' => 'true',
            'view' => view('project.admin.companies.ajax.studentNominationList', ['data' => $data])->render()
        ]);
    }

    public function add_nomination_table_ajax(Request $request)
    {
        $data = new StudentCompanyNominationModel();
        $data->scn_student_id = $request->student_id;
        $data->scn_company_id = $request->company_id;
        $data->scn_semester = SystemSetting::first()->ss_semester_type ?? '';
        $data->scn_year = SystemSetting::first()->ss_year ?? '';
        if ($data->save()) {
            return response()->json([
                'success' => 'true',
            ]);
        } else {
            return response()->json([
                'success' => 'fail',
            ]);
        }
    }

    public function delete_nomination_table_ajax(Request $request)
    {
        $data = StudentCompanyNominationModel::where('scn_id', $request->id)->first();
        if ($data->delete()) {
            return response()->json([
                'success' => 'true',
                'message' => 'تم ازالة الطالب بنجاح'
            ]);
        } else {
            return response()->json([
                'success' => 'fail',
                'message' => 'هناك خلل ما لم يتم ازالة الطالب'
            ]);
        }
    }

    public function update_capacity_ajax(Request $request)
    {
        $data = Company::where('c_id', $request->id)->first();
        $data->c_capacity = $request->value;
        if ($data->save()) {
            return response()->json([
                'success' => 'true'
            ]);
        }
    }

    public function update_company_status(Request $request)
    {
        $data = Company::where('c_id', $request->company_id)->first();
        $data->c_status = $request->status;
        if ($data->save()) {
            return response()->json([
                'success' => 'true',
            ]);
        }
    }
}
