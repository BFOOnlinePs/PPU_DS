<?php

namespace App\Http\Controllers\project\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompaniesCategory;
use App\Models\User;
use App\Models\CompanyBranch;
use App\Models\CompanyDepartment;
use App\Models\companyBranchDepartments;


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
    public function company(Request $request)
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

        // if($data->save()){
        //     $user = User::where('email',$request->email)->first();
        //     $id = $user->u_id;
        //     $newCompany = new Company;
        //     $newCompany->c_name = $request->c_name;
        //     $newCompany->c_manager_id=$id;//get from added user
        //     if($newCompany->save()){
        //         return response()->json([
        //             'success'=>'true',
        //             'manager_id'=>$id,
        //             'company_id'=>$newCompany->c_id
        //         ]);
        //     }
        // }

        return response()->json([
            'success'=>'true',
            'data'=>"all has done"
        ]);

    }

    public function edit($id){
        $uncompletedCompany = Company::with('manager')->where('c_type',null)->get();
        $categories = CompaniesCategory::get();
        $data = Company::with('manager','companyCategories','companyBranch.companyDepartments','companyDepartments')->where('c_id',$id)->first();
        // $companyDepartments=CompanyBranch::with('companyDepartments')->where('b_company_id',$id)->get();
        $companyDepartments=CompanyDepartment::where('d_company_branch_id',$id)->get();

    //return $data;
        return view('project.admin.companies.edit',['company'=>$data,'categories'=>$categories,'uncompletedCompany'=>$uncompletedCompany,'companyDepartments'=>$companyDepartments]);

    }

    //this function for update inserted company in add company page
    public function updateCompany(Request $request){

        // $data = Company::where('c_manager_id',$request->manager_id)->first();
        // if($request->c_description!=null){
        //     $data->c_description = $request->c_description;
        // }
        // if($request->c_website!=null){
        //     $data->c_website = $request->c_website;
        // }
        // $data->c_type = $request->c_type;
        // $data->c_category_id = $request->c_category;

        // if($data->save()){
        //     return response()->json([
        //         'success'=>'true',
        //         'data'=>"all has done"
        //     ]);
        // }

        return response()->json([
            'success'=>'true',
            'data'=>"all has done"
        ]);
    }
 public function update(Request $request){

    $user = User::where('u_id',$request->manager_id)->first();
    $user->u_username = $request->email;
    $user->name = $request->name;
    $user->email = $request->email;
    if($request->password != null){
    $user->password = bcrypt($request->password);
    }
    $user->u_phone1 = $request->phoneNum;
    $user->u_address = $request->address;

    $company = Company::where('c_id',$request->c_id)->first();
    $company->c_type = $request->c_type;
    $company->c_category_id = $request->c_category;
    if($request->c_description!=null){
        $company->c_description = $request->c_description;
    }
    if($request->c_website!=null){
        $company->c_website = $request->c_website;
    }

    if($user->save() && $company->save() ){
        $company = Company::with('manager','companyCategories')->where('c_id',$request->c_id)->first();
        $categories = CompaniesCategory::get();
        $companyDepartment=CompanyDepartment::where('d_company_branch_id',$request->c_id)->get();

   return response()->json([
            'success'=>'true',
            'company1'=> $company,
            'view'=>view('project.admin.companies.ajax.companyInfoForm',['company'=>$company,'categories'=>$categories,'companyDepartment',$companyDepartment])->render()
        ]);
}

}
 public function updateDepartments(Request $request){
    $companyDepartments=CompanyDepartment::where('d_company_branch_id',$request->c_id)->get();
    foreach($companyDepartments as $key){
    // for($i = 0 ; $i<count($companyDepartments) ; $i++){
        $d_name='d_name_'.$key->d_id;

        $companyDepartment=CompanyDepartment::where('d_id',$key->d_id)->first();
        $companyDepartment->d_name = $request->$d_name;
        $companyDepartment->save();
    }

    // foreach($companyDepartments as $x){
    //     $companyDepartment=CompanyDepartment::where('d_id',$x->d_id)->first();
    //     $companyDepartment->d_name = $request->d_name_

    // }

    if($companyDepartment->save()){
        $company = Company::with('manager','companyCategories')->where('c_id',$request->c_id)->first();
        $companyDepartments=CompanyDepartment::where('d_company_branch_id',$request->c_id)->get();
        $categories = CompaniesCategory::get();
   return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.companies.ajax.departmentForm',['company'=>$company,'categories'=>$categories,'companyDepartments'=>$companyDepartments])->render()
        ]);
}

}
    //reem
    public function createBranches(Request $request){

        $newlyCreatedId = 0;
        $departmentsList = json_decode($request->departmentsList, true);
        //$company_id=Company::where('c_manager_id',$request->manager_id)->first()->c_id;



        // for($i = 1;$i<=$request->branchesNum;$i++)
        // {
        //     $data = new CompanyBranch;
        //     $data->b_company_id = $company_id;
        //     $address = 'address'. $i;
        //     $data->b_address = $request->$address;
        //     $phone1 = 'phone1_'. $i;
        //     $data->b_phone1 = $request->$phone1;
        //     $phone2 = 'phone2_'. $i;
        //     if($request->$phone2 != null){
        //         $data->b_phone2 = $request->$phone2;
        //     }
        //     $data->b_manager_id = $request->manager_id;
        //     if($i==1){
        //         $data->b_main_branch = 1;
        //     }else{
        //         $data->b_main_branch = 0;
        //     }
        //     if($data->save()){
        //         $departments = 'department_for_'. $i;
        //         if($request->$departments!=null){

        //             $newlyCreatedId = $data->b_id;
        //             $branchDepartments = json_decode($request->$departments, true);
        //             for($r=0;$r<count($branchDepartments);$r++){
        //                 $branchDepartment = new companyBranchDepartments;
        //                 $branchDepartment->cbd_company_branch_id = $newlyCreatedId;


        //                 ///to get department name///////////////////
        //                 $departmentName = $branchDepartments[$r];
        //                 $departmentName = $departmentsList[$departmentName];
        //                 ////////////////////////////////////////////

        //                 $depID=CompanyDepartment::where('d_company_id',$company_id)
        //                 ->where('d_name',$departmentName)->first()->d_id;

        //                 $branchDepartment->cbd_d_id= $depID;

        //                 $branchDepartment->save();
        //             }

        //         }
        //     }
        // }



        return response()->json([
            'success'=>'true',
        ]);


    }

    //noor
    public function createBranchesEdit(Request $request){


        $departmentsList = json_decode($request->departmentsList);

        // $company_id=Company::where('c_id',$request->c_id)->first();
        $mainBranch=CompanyBranch::where('b_company_id',$request->c_id)->where('b_main_branch',1)->first();
        $x= $request->phone2!=null;

            $data = new CompanyBranch;

            $data->b_company_id = $request->c_id;
            $data->b_address = $request->address;
            $data->b_phone1 = $request->phone1;
            if($x ==1){
                $data->b_phone2 = $request->phone2;
            }
            $data->b_manager_id = $request->manager_id;
             if($mainBranch){
            $data->b_main_branch = 0;
        }else{
            $data->b_main_branch = 1;
        }




          if($data->save()){
            for($i = 0 ; $i < count($departmentsList) ; $i++ ){
                $companyBranchDepartments = new companyBranchDepartments;
                $companyBranchDepartments->cbd_company_branch_id=$request->c_id;
                $companyBranchDepartments->cbd_d_id=$departmentsList[$i];
                $companyBranchDepartments->save();
                }
        $company = Company::with('manager','companyCategories','companyBranch.companyDepartments','companyDepartments')->where('c_id',$request->c_id)->first();
        $categories = CompaniesCategory::get();
        $companyDepartments=CompanyBranch::with('companyDepartments')->where('b_company_id',$request->c_id)->get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.companies.ajax.companyBranches',['company'=>$company,'categories'=>$categories,'companyDepartments'=>$companyDepartments])->render()

            ]);
          }




    }


    //noor
    public function updateBranches(Request $request){

       // $mainBranch=CompanyBranch::where('b_id',$request->b_id)->where('b_main_branch',1)->first();
        //$departmentsList = json_decode($request->departmentsList, true);
        $data=CompanyBranch::where('b_id',$request->b_id)->first();
        $address = 'address_'. $request->b_id;
        $phone1 = 'phone1_'. $request->b_id;
        $phone2 = 'phone2_'. $request->b_id;
        $manager_id = 'manager_id_'. $request->b_id;
        $c_id = 'c_id_'. $request->b_id;
            $x= $request->$phone2!=null;
            $data->b_address = $request->$address;
            $data->b_phone1 = $request->$phone1;
            if($x ==1){
                $data->b_phone2 = $request->$phone2;
            }
            $data->b_manager_id = $request->$manager_id;
            // if($mainBranch){
            //     $data->b_main_branch = 1;
            // }else{
            //     $data->b_main_branch = 0;
            // }
          if($data->save()){
        $company = Company::with('manager','companyCategories','companyBranch.companyDepartments','companyDepartments')->where('c_id',$request->$c_id)->first();
        $categories = CompaniesCategory::get();
        $companyDepartments=CompanyBranch::with('companyDepartments')->where('b_company_id',$request->$c_id)->get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.companies.ajax.companyBranches',['company'=>$company,'categories'=>$categories,'companyDepartments'=>$companyDepartments])->render()

            ]);
          }




    }

    //noor
    public function addDepartment(Request $request){




            $data = new CompanyDepartment;
            $data->d_name = $request->d_name;
            $data->d_company_branch_id = $request->d_company_id;//must be  d_company_id until change the attribute in DB and reems' Tasks

          if($data->save()){
        $company = Company::with('manager','companyCategories','companyBranch.companyDepartments','companyDepartments')->where('c_id',$request->d_company_id)->first();
        $categories = CompaniesCategory::get();
        $companyDepartments=CompanyDepartment::where('d_company_branch_id',$request->d_company_id)->get();
            return response()->json([
                'success'=>'true',
                'view'=>view('project.admin.companies.ajax.departmentForm',['company'=>$company,'categories'=>$categories,'companyDepartments'=>$companyDepartments])->render()

            ]);
          }




    }


    //reem
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

    //reem
    public function companySearch(Request $request){
        $data = Company::with('manager','companyCategories')->where('c_name','like','%'.$request->search.'%')->get();

        return response()->json([
            'success'=>'true',
            'view'=>view('project.admin.companies.ajax.companyList',['data'=>$data])->render()
        ]);
    }

    //reem
    public function createDepartments(Request $request){
        $companyDepartments = json_decode($request->departments, true);
        for($r=0;$r<count($companyDepartments);$r++){
            $department = new CompanyDepartment;
            $department->d_name = $companyDepartments[$r];
            $department->d_company_id = $request->companyID;
            $department->save();
        }
        return response()->json([
            'success'=>'true'
        ]);
    }




}
