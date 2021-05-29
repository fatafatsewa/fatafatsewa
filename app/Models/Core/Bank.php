<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
  protected $fillable = ['name', 'email', 'available_options', 'email_template', 'emi_form'];


  public function getEmiFormFileAttribute() {
    return url('resources/assets/banks/' . $this->id .'/'. $this->emi_form);
  }
}
