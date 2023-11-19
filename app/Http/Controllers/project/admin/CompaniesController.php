<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompaniesCategory;
use App\Models\User;
use App\Models\CompanyBranch;
use App\Models\CompanyDepartment;


class CompaniesController extends Controller
{
    //
    public function index()
    {
        $data = Company::with('manager','companyCategories')->get();

        // $uncompletedCompany = Company::with('manager')->where('c_type',null)->get();
        // return $uncompletedCompany;



        //return $data;
        return view('project.admin.companies.index',['data'=>$data]);
    }

    //add new company page
    public function company()
    {
        ////////////////////////////TO DOOOOOO//////////////////////////////////////
        //check if there is company without data return it here
        //and in index page put popup that has link to continue editing this company
        ////////////////////////////////////////////////////////////////////////////

        $uncompletedCompany = Company::with('manager')->where('c_type',null)->get();
        //$uncompletedCompany = json_encode($uncompletedCompany, true);

        //return count($nonCompletedCompany);

        $categories = CompaniesCategory::get();
        return view('project.admin.companies.company',['categories'=>$categories,'uncompletedCompany'=>$uncompletedCompany]);
    }

    public function create(Request $request){

        $data = new User;
        $data->u_username = $request->email;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->u_phone1 = $request->phoneNum;
        $data->u_address = $request->address;
        $data->u_role_id = 6;

        if($data->save()){
            $user = User::where('email',$request->email)->first();
            $id = $user->u_id;
            $newCompany = new Company;
            $newCompany->c_name = $request->c_name;
            $newCompany->c_manager_id=$id;//get from added user
            if($newCompany->save()){
                return response()->json([
                    'success'=>'true',
                    'manager_id'=>$id,
                    'company_id'=>$newCompany->c_id
                ]);
            }
        }

        // return response()->json([
        //     'success'=>'true',
        //     'data'=>"all has done"
        // ]);

    }

    public function edit($id){
        $data = Company::with('manager','companyCategories')->where('c_id',$id)->first();
        return view('project.admin.companies.edit',['company'=>$data]);
    }

    //this function for update inserted company in add company page
    public function updateCompany(Request $request){

        $data = Company::where('c_manager_id',$request->manager_id)->first();
        if($request->c_description!=null){
            $data->c_description = $request->c_description;
        }
        if($request->c_website!=null){
            $data->c_website = $request->c_website;
        }
        $data->c_type = $request->c_type;
        $data->c_category_id = $request->c_category;

        if($data->save()){
            return response()->json([
                'success'=>'true',
                'data'=>"all has done"
            ]);
        }

        // return response()->json([
        //     'success'=>'true',
        //     'data'=>"all has done"
        // ]);
    }

    public function createBranches(Request $request){

        $newlyCreatedId = 0;
        $departmentsList = json_decode($request->departmentsList, true);
        $company_id=Company::where('c_manager_id',$request->manager_id)->first()->c_id;



        for($i = 1;$i<=$request->branchesNum;$i++)
        {
            $data = new CompanyBranch;
            $data->b_company_id = $company_id;
            $address = 'address'. $i;
            $data->b_address = $request->$address;
            $phone1 = 'phone1_'. $i;
            $data->b_phone1 = $request->$phone1;
            $phone2 = 'phone2_'. $i;
            if($request->$phone2 != null){
                $data->b_phone2 = $request->$phone2;
            }
            $data->b_manager_id = $request->manager_id;
            if($i==1){
                $data->b_main_branch = 1;
            }else{
                $data->b_main_branch = 0;
            }
            if($data->save()){
                $departments = 'department_for_'. $i;
                if($request->$departments!=null){

                    $newlyCreatedId = $data->b_id;
                    $branchDepartment = json_decode($request->$departments, true);
                    for($r=0;$r<count($branchDepartment);$r++){
                        $department = new CompanyDepartment;
                        $department->d_company_branch_id = $newlyCreatedId;
                        $departmentName = $branchDepartment[$r];
                        $departmentName = $departmentsList[$departmentName];
                        $department->d_name=$departmentName;
                        $department->save();
                    }

                }
            }
        }



        // return response()->json([
        //     'success'=>'true',
        //     // 'data'=>json_decode($request->department_for_1, true),
        //     // 'list'=>$departmentsList,
        //     // 'company_id'=>$company_id
        // ]);


    }

    public function checkCompany(Request $request){

        $data = Company::where('c_name',$request->search)->first();

        if($data!=null){

            $company_id = $data->c_id;
            $company_name = $data->c_name;

            return response()->json([
                'success'=>'true',
                'company_id'=>$company_id,
                'company_name'=>$company_name,
                'data'=>$data
            ]);

        }else{
            return response()->json([
                'success'=>'true',
                'data'=>$data
            ]);
        }

    }

    public function companySearch(Request $request){
        $data = Company::with('manager','companyCategories')->where('c_name','like','%'.$request->search.'%')->get();

        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.companies.ajax.companyList',['data'=>$data])->render()
        ]);
    }



}
