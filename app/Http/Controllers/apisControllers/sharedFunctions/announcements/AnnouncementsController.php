<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\announcements;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementsController extends Controller
{
    public function getAllActiveAnnouncements()
    {
        $announcements = AnnouncementModel::where('a_status', 1)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'announcements' => $announcements,
        ]);
    }

    public function getAllAnnouncements()
    {
        $announcements = AnnouncementModel::orderBy('created_at', 'desc')->with('addedBy:u_id,name')->paginate(50);

        return response()->json([
            'pagination' => [
                'current_page' => $announcements->currentPage(),
                'last_page' => $announcements->lastPage(),
                'per_page' => $announcements->perPage(),
                'total_items' => $announcements->total(),
            ],
            'announcements' => $announcements->items(),
        ]);
    }


    public function getUserAnnouncements()
    {
        $announcements = AnnouncementModel::where('a_added_by', auth()->user()->u_id)
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return response()->json([
            'pagination' => [
                'current_page' => $announcements->currentPage(),
                'last_page' => $announcements->lastPage(),
                'per_page' => $announcements->perPage(),
                'total_items' => $announcements->total(),
            ],
            'announcements' => $announcements->items(),
        ]);
    }

    public function addNewAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg',
        ], [
            'title.required' => 'الرجاء إرسال العنوان الخاص بالإعلان',
            'content.required' => 'الرجاء إرسال المحتوى الخاص بالإعلان',
            'image.image' => 'الحقل يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من إحدى الصيغ التالية jpg,jpeg,png,svg',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->first(),
            ], 400);
        }

        $announcement = new AnnouncementModel();

        $announcement->a_title = $request->title;
        $announcement->a_content = $request->content;
        $announcement->a_added_by = auth()->user()->u_id;
        $announcement->a_status = 0; // un active

        if ($request->hasFile('image')) {
            // return $request->file('image');
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $folderPath = 'uploads/announcements';
            $request->file('image')->storeAs($folderPath, $fileName, 'public');

            $announcement->a_image = $fileName;
        }

        if ($announcement->save()) {
            return response()->json([
                'status' => true,
                'message' => 'تم إضافة الإعلان بنحاح',
                'announcement' => $announcement
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'حصل خلل أثناء حفظ المعلومات',
            ], 500);
        }
    }

    public function changeAnnouncementStatus(Request $request, $announcement_id)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $announcement = AnnouncementModel::where('a_id', $announcement_id)->first();
        // return $announcement;
        if (!$announcement) {
            return response()->json([
                'status' => false,
                'message' => 'الإعلان غير موجود',
            ], 404);
        }

        $announcement->a_status = $request->input('status');

        if ($announcement->save()) {
            return response()->json([
                'status' => true,
                'message' => 'تم تحديث حالة الاعلان بنجاح',
                'announcement' => $announcement
            ], 200);
        }
    }

    public function editAnnouncement(Request $request, $announcement_id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg',
            'is_image_deleted' => 'in:true,false'
        ], [
            'title.required' => 'الرجاء إرسال العنوان الخاص بالإعلان',
            'content.required' => 'الرجاء إرسال المحتوى الخاص بالإعلان',
            'image.image' => 'الحقل يجب أن يكون صورة',
            'image.mimes' => 'الصورة يجب أن تكون من إحدى الصيغ التالية jpg,jpeg,png,svg',
            // 'is_image_deleted.boolean' => ''
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        $announcement = AnnouncementModel::where('a_id', $announcement_id)->first();

        if (!$announcement) {
            return response()->json([
                'status' => false,
                'message' => 'الإعلان غير موجود',
            ], 404);
        }


        // Update the title and content
        $announcement->a_title = $request->input('title');
        $announcement->a_content = $request->input('content');

        if ($request->input('is_image_deleted')) {
            $announcement->a_image = null;
        }

        // image : the new image     (if changed)
        // hasFile('image') = false  (if nothing happened)
        if ($request->hasFile('image')) {
            // return $request->file('image');
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $folderPath = 'uploads/announcements';
            $request->file('image')->storeAs($folderPath, $fileName, 'public');

            $announcement->a_image = $fileName;
        }

        if ($announcement->save()) {
            return response()->json([
                'status' => true,
                'message' => 'تم تحديث الإعلان بنجاح',
                'announcement' => $announcement
            ], 200);
        }
    }
}
