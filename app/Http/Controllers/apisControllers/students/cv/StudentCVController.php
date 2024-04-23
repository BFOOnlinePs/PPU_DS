<?php

namespace App\Http\Controllers\apisControllers\students\cv;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentCVController extends Controller
{
    public function addStudentCV(Request $request)
    {
        $studentId = Auth::user()->u_id;

        $student = User::where('u_id', $studentId)->first();

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'رقم الطالب غير موجود',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:jpg,jpeg,png,svg,pdf,doc,docx,ppt,pptx',
        ], [
            'cv.required' => 'يجب ارسال السيرة الذاتية',
            'cv.file' => 'يجب ان يكون ملف',
            'cv.mimes' => 'الصيغة غير مدعومة، جرب صيغة أخرى'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }


        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $folderPath = 'uploads';
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $request->file('cv')->storeAs($folderPath, $fileName, 'public');

            $student->u_cv = $fileName;
            $student->u_cv_updated_at = now();
            $student->u_cv_status = 0; // not approved

            if ($student->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'تم إضافة السيرة الذاتية بنجاح',
                    'cvFileName' => $student->u_cv,
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'يوجد شيء خاطئ'
        ]);
    }
}
