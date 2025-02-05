<?php

namespace App\Http\Controllers\apisControllers\sharedFunctions\faq;

use App\Http\Controllers\Controller;
use App\Models\FrequentlyAskedQuestionModel;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // Get all FAQs based on the target role
    public function index(Request $request)
    {
        $target_role = $request->query('target_role'); // int

        if (!$target_role) {
            return response()->json([
                'status' => 'false',
                'message' => 'target role id is required'
            ]);
        }

        $faqs = FrequentlyAskedQuestionModel::whereJsonContains('faq_target_role_ids', $target_role)
            ->select('faq_id', 'faq_question', 'faq_mobile_answer', 'created_at')
            ->get();

        return response()->json([
            'status' => 'true',
            'faqs' => $faqs
        ]);
    }
}
