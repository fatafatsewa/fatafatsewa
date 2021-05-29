<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use Exception;
use Omnipay\Omnipay;

class EsewaHelper
{
  protected $payment_gateway;

  public function __construct($payment_setting)
  {
    $this->payment_gateway = Omnipay::create('PhpEsewa_Secure');
    $this->payment_gateway->setScd($payment_setting->value);
    $this->payment_gateway->setTestMode($payment_setting->environment === 1 ? false : true);
  }

  public function processPayment($amount)
  {
    try {
      $response = $this->payment_gateway->purchase([
        'amt' => $amount,
        'txAmt' => 0,
        'psc' => 0,
        'pdc' => 0,
        'tAmt' => $amount,
        'pid' => Carbon::now()->timestamp . '-U-' . auth('customer')->user()->id, //Your Purchase Unique ID
        'su' => route('esewa-completed', ['status' => 'passed', 'payment_amount' => $amount]),
        'fu' => route('esewa-completed', ['status' => 'failed', 'payment_amount' => $amount]),
      ])->send();
    } catch (Exception $e) {
      return false;
    }
    if ($response->isRedirect()) {
      $response->redirect();
    } else {
      return false;
      //return back with some proper payment somehow failed message.
    }
  }

  public function verifyPayment($data)
  {
    $response = $this->payment_gateway->verifyPayment([
      'amt' => $data['payment_amount'],
      'rid' => $data['refId'],
      'pid' => $data['oid'],
    ])->send();


    if ($response->isSuccessful()) {
      return true;
    } else {
      return false;
    }
  }
}
