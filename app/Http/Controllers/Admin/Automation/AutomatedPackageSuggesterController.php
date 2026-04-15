<?php

namespace App\Http\Controllers\Admin\Automation;

use App\Helpers\ApiAIHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutomatedPackageSuggesterController extends Controller
{
    public function index()
    {
        return view('admin.automation.automated-package-suggester');
    }

    public function suggest()
    {
        $suggestion = ApiAIHelper::getApiAiResponse();
        return response()->json($suggestion);
    }
}
