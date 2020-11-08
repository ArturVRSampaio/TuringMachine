<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// competencias de uma MQT:
//
//shift left
//shift left
//
//right
//read
//
//process
//
//
//
//
//
//
//

$tm = new Func("tm", function($I = null, $tape = null, $end = null, $state = null, $i = null, $cell = null, $current = null) {
  $i = 0.0;
  while (!eq($state, $end)) {
    $cell = get($tape, $i);
    $current = is($cell) ? get(get($I, $state), $cell) : get(get($I, $state), "B");
    if (not($current)) {
      return false;
    }
    call_method($tape, "splice", $i, 1.0, get($current, "w"));
    $i += get($current, "m");
    $state = get($current, "n");
  }
  return $tape;
});