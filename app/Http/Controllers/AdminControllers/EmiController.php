<?php

namespace App\Http\Controllers\AdminControllers;

use App\ExchangeRequest;
use App\Http\Controllers\Controller;
use App\Models\Core\AppliedEmi;
use App\Models\Core\Setting;

class EmiController extends Controller
{
  public function __construct(AppliedEmi $emi, Setting $setting)
  {
    $this->emi = $emi;
    $this->Setting = $setting;
  }

  public function index()
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $emis = $this->emi->latest()->get();
    $result['emis'] = $emis;
    return view("admin.applied-emi.index")->with('result', $result);
  }

  public function viewDetail($emi_id) {
    $emi = AppliedEmi::findOrFail($emi_id);

    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $result['emi'] = $emi;
    return view("admin.applied-emi.view")->with('result', $result);
  }
}
