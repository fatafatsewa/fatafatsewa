<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Bank;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BanksController extends Controller
{
  public function __construct(Bank $bank, Setting $setting)
  {
    $this->bank = $bank;
    $this->Setting = $setting;
  }

  public function index()
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $banks = $this->bank->get();
    $result['banks'] = $banks;
    return view("admin.banks.index")->with('result', $result);
  }

  public function add(Request $request)
  {
    $title = array('pageTitle' => "Add Bank");
    $result['commonContent'] = $this->Setting->commonContent();
    return view("admin.banks.add", $title)->with('result', $result);
  }

  public function insert(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'email_template' => 'required',
      'available_options' => 'required'
    ]);

    $bank = Bank::create([
      'name' => $request->name,
      'email' => $request->email,
      'email_template' => $request->email_template,
      'available_options' => implode(',', $request->available_options)
    ]);

    $emi_form = null;
    if ($request->file('emi_form')) {
      $emi_form = $this->moveFile($request->file('emi_form'), $bank->id);
      $bank->update([
        'emi_form' => $emi_form
      ]);
    }

    return redirect('/admin/banks/display');
  }

  public function edit($bank_id)
  {
    $result = [];
    $result['commonContent'] = $this->Setting->commonContent();
    $bank = $this->bank->findOrFail($bank_id);
    $result['bank'] = $bank;
    return view("admin.banks.edit")->with('result', $result);
  }

  public function update($bank_id, Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'email_template' => 'required',
      'available_options' => 'required'
    ]);
    $title = array('pageTitle' => 'Edit Bank');
    $result = array();
    $bank = Bank::findOrFail($bank_id);
    $bank->update([
      'name' => $request->name,
      'email' => $request->email,
      'email_template' => $request->email_template,
      'available_options' => implode(',', $request->available_options)
    ]);

    $emi_form = null;
    if ($request->file('emi_form')) {
      $emi_form = $this->moveFile($request->file('emi_form'), $bank->id);
      $bank->update([
        'emi_form' => $emi_form
      ]);
    }

    $result['commonContent'] = $this->Setting->commonContent();
    return redirect('/admin/banks/display');

    // return view("admin.currencies.edit", ['title' => $title])->with('result', $result);

  }

  public function moveFile($file, $bank_id)
  {
    $fileName = Carbon::now()->timestamp . '-' . dechex(rand(1000, 100000)) . '.' . $file->getClientOriginalExtension();
    $path = $file->move(public_path('resources/assets/banks/' . $bank_id), $fileName);
    return $fileName;
  }
}
