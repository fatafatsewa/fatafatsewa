


<?php


if (!function_exists('currencyFormat')) {
 /**
  * Get an instance of the current request or an input item from the request.
  *
  * @param  array|string|null  $key
  * @param  mixed  $default
  * @return \Illuminate\Http\Request|string|array
  */
 function currencyFormat($amt)
 {
  $amount = new \NumberFormatter('en_EN', \NumberFormatter::CURRENCY);
  $amount->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
  $amount->setSymbol(NumberFormatter::CURRENCY_SYMBOL, 'Rsss.');
  return $amount->format($amt);
 }
}
