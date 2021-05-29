<?php

namespace App\Http\Controllers\AdminControllers;

use App\ExchangeRequest;
use App\RepairRequest;
use App\Http\Controllers\Controller;
use App\Models\Core\Setting;

class ExchangeController extends Controller
{
  public function __construct(ExchangeRequest $exchangeRequest, Setting $setting)
  {
    $this->exchange_request = $exchangeRequest;
    $this->Setting = $setting;
  }

  public function index()
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $exchange_requests = $this->exchange_request->latest()->get();
    $result['exchange_requests'] = $exchange_requests;
    return view("admin.exchange-requests.index")->with('result', $result);
  }

  public function viewRequestDetail($request_id) {
    $exchange_request = ExchangeRequest::findOrFail($request_id);

    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $result['exchange_request'] = $exchange_request;
    return view("admin.exchange-requests.view")->with('result', $result);
  }

  //repair
  public function repair()
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $repair_requests = $this->repair_request->latest()->get();
    $result['repair_requests'] = $repair_requests;
    return view("admin.repair-requests.index")->with('result', $result);
  }
}
