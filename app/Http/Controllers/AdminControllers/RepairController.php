<?php

namespace App\Http\Controllers\AdminControllers;

use App\RepairRequest;
use App\Http\Controllers\Controller;
use App\Models\Core\Setting;

class RepairController extends Controller
{
  public function __construct(RepairRequest $repairRequest, Setting $setting)
  {
    $this->repair_request = $repairRequest;
    $this->Setting = $setting;
  }

  public function index()
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $repair_requests = $this->repair_request->latest()->get();
    $result['repair_requests'] = $repair_requests;
    return view("admin.repair-requests.index")->with('result', $result);
  }

  public function viewRequestDetail($request_id) {
    $repair_request = RepairRequest::findOrFail($request_id);

    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $result['repair_request'] = $repair_request;
    return view("admin.repair-requests.view")->with('result', $result);
  }

}
