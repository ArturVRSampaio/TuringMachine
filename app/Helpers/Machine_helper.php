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
$nDebugLevel = null; $bFullSpeed = null; $bIsReset = null; $sTape = null; $nTapeOffset = null; $nHeadPosition = null; $sState = null; $nSteps = null; $nVariant = null; $hRunTimer = null; $aProgram = null; $nMaxUndo = null; $aUndoList = null; $nTextareaLines = null; $oTextarea = null; $bIsDirty = null; $oNextLineMarker = null; $oPrevLineMarker = null; $oPrevInstruction = null; $sPreviousStatusMsg = null;
$Step = new Func("Step", function() use (&$bIsDirty, &$Compile, &$bIsReset, &$sState, &$SetStatusMessage, &$EnableControls, &$GetTapeSymbol, &$nHeadPosition, &$GetNextInstructions, &$nVariant, &$Math, &$debug, &$nMaxUndo, &$aUndoList, &$SetTapeSymbol, &$nSteps, &$oPrevInstruction, &$sTape, &$UpdateInterface) {
  $sNewState = null; $sNewSymbol = null; $nAction = null; $nLineNumber = null; $sHeadSymbol = null; $aInstructions = null; $oInstruction = null;
  if (is($bIsDirty)) {
    call($Compile);
  }
  $bIsReset = false;
  if (eq(call_method(call_method($sState, "substring", 0.0, 4.0), "toLowerCase"), "halt")) {
    call($SetStatusMessage, "Halted.");
    call($EnableControls, false, false, false, true, true, true, true);
    return false;
  }
  $sHeadSymbol = call($GetTapeSymbol, $nHeadPosition);
  $aInstructions = call($GetNextInstructions, $sState, $sHeadSymbol);
  if (eq(get($aInstructions, "length"), 0.0)) {
    $oInstruction = Object::$null;
  } else if (eq($nVariant, 2.0)) {
    $oInstruction = get($aInstructions, call_method($Math, "floor", call_method($Math, "random") * get($aInstructions, "length")));
  } else {
    $oInstruction = get($aInstructions, 0.0);
  }


  if (!eq($oInstruction, Object::$null)) {
    $sNewState = eq(get($oInstruction, "newState"), "*") ? $sState : get($oInstruction, "newState");
    $sNewSymbol = eq(get($oInstruction, "newSymbol"), "*") ? $sHeadSymbol : get($oInstruction, "newSymbol");
    $nAction = eq(call_method(get($oInstruction, "action"), "toLowerCase"), "r") ? 1.0 : (eq(call_method(get($oInstruction, "action"), "toLowerCase"), "l") ? -1.0 : 0.0);
    if (eq($nVariant, 1.0) && eq($nHeadPosition, 0.0) && eq($nAction, -1.0)) {
      $nAction = 0.0;
    }
    $nLineNumber = get($oInstruction, "sourceLineNumber");
  } else {
    call($debug, 1.0, _concat("Warning: no instruction found for state '", $sState, "' symbol '", $sHeadSymbol, "'; halting"));
    call($SetStatusMessage, _concat("Halted. No rule for state '", $sState, "' and symbol '", $sHeadSymbol, "'."), 2.0);
    $sNewState = "halt";
    $sNewSymbol = $sHeadSymbol;
    $nAction = 0.0;
    $nLineNumber = -1.0;
  }

  if ($nMaxUndo > 0.0) {
    if (get($aUndoList, "length") >= $nMaxUndo) {
      call_method($aUndoList, "shift");
    }
    call_method($aUndoList, "push", new Object("state", $sState, "position", $nHeadPosition, "symbol", $sHeadSymbol));
  }
  call($SetTapeSymbol, $nHeadPosition, $sNewSymbol);
  $sState = $sNewState;
  $nHeadPosition += $nAction;
  $nSteps++;
  $oPrevInstruction = $oInstruction;
  call($debug, 4.0, _concat("Step() finished. New tape: '", $sTape, "'  new state: '", $sState, "'  action: ", $nAction, "  line number: ", $nLineNumber));
  call($UpdateInterface);
  if (eq(call_method(call_method($sNewState, "substring", 0.0, 4.0), "toLowerCase"), "halt")) {
    if (!eq($oInstruction, Object::$null)) {
      call($SetStatusMessage, "Halted.");
    }
    call($EnableControls, false, false, false, true, true, true, true);
    return false;
  } else {
    if (is(get($oInstruction, "breakpoint"))) {
      call($SetStatusMessage, _concat("Stopped at breakpoint on line ", $nLineNumber, 1.0));
      call($EnableControls, true, true, false, true, true, true, true);
      return false;
    } else {
      return true;
    }

  }

});
$Undo = new Func("Undo", function() use (&$aUndoList, &$nSteps, &$sState, &$nHeadPosition, &$SetTapeSymbol, &$oPrevInstruction, &$debug, &$EnableControls, &$SetStatusMessage, &$UpdateInterface) {
  $oUndoData = null;
  $oUndoData = call_method($aUndoList, "pop");
  if (is($oUndoData)) {
    $nSteps--;
    $sState = get($oUndoData, "state");
    $nHeadPosition = get($oUndoData, "position");
    call($SetTapeSymbol, $nHeadPosition, get($oUndoData, "symbol"));
    $oPrevInstruction = Object::$null;
    call($debug, 3.0, _concat("Undone one step. New state: '", $sState, "' position : ", $nHeadPosition, " symbol: '", get($oUndoData, "symbol"), "'"));
    call($EnableControls, true, true, false, true, true, true, true);
    call($SetStatusMessage, "Undone one step.");
    call($UpdateInterface);
  } else {
    call($debug, 1.0, "Warning: Tried to undo with no undo data available!");
  }

});
$Run = new Func("Run", function() use (&$bFullSpeed, &$Step, &$hRunTimer, &$window, &$UpdateInterface) {
  $Run = Func::getCurrent();
  $bContinue = null; $i = null;
  $bContinue = true;
  if (is($bFullSpeed)) {
    for ($i = 0.0; is($bContinue) && $i < 25.0; $i++) {
      $bContinue = call($Step);
    }
    if (is($bContinue)) {
      $hRunTimer = call_method($window, "setTimeout", $Run, 10.0);
    } else {
      call($UpdateInterface);
    }

  } else {
    if (is(call($Step))) {
      $hRunTimer = call_method($window, "setTimeout", $Run, 50.0);
    }
  }

});
$RunStep = new Func("RunStep", function() use (&$Step, &$StopTimer) {
  if (not(call($Step))) {
    call($StopTimer);
  }
});
$StopTimer = new Func("StopTimer", function() use (&$hRunTimer, &$window) {
  if (!eq($hRunTimer, Object::$null)) {
    call_method($window, "clearInterval", $hRunTimer);
    $hRunTimer = Object::$null;
  }
});
$Reset = new Func("Reset", function() use (&$�24�, &$nHeadPosition, &$sTape, &$nTapeOffset, &$sState, &$nVariant, &$Number, &$SetupVariantCSS, &$nSteps, &$bIsReset, &$Compile, &$oPrevInstruction, &$aUndoList, &$ShowResetMsg, &$EnableControls, &$UpdateInterface) {
  $sInitialTape = null; $sInitialState = null; $dropdown = null;
  $sInitialTape = get(get(call($�24�, "#InitialInput"), 0.0), "value");
  $nHeadPosition = call_method($sInitialTape, "indexOf", "*");
  if (eq($nHeadPosition, -1.0)) {
    $nHeadPosition = 0.0;
  }
  $sInitialTape = call_method(call_method($sInitialTape, "replace", new RegExp("\\*", "g"), ""), "replace", new RegExp(" ", "g"), "_");
  if (eq($sInitialTape, "")) {
    $sInitialTape = " ";
  }
  $sTape = $sInitialTape;
  $nTapeOffset = 0.0;
  $sInitialState = get(get(call($�24�, "#InitialState"), 0.0), "value");
  $sInitialState = get(call_method(call_method($�24�, "trim", $sInitialState), "split", new RegExp("\\s+", "")), 0.0);
  if (not($sInitialState) || eq($sInitialState, "")) {
    $sInitialState = "0";
  }
  $sState = $sInitialState;
  $dropdown = get(call($�24�, "#MachineVariant"), 0.0);
  $nVariant = call($Number, get(get(get($dropdown, "options"), get($dropdown, "selectedIndex")), "value"));
  call($SetupVariantCSS);
  $nSteps = 0.0;
  $bIsReset = true;
  call($Compile);
  $oPrevInstruction = Object::$null;
  $aUndoList = new Arr();
  call($ShowResetMsg, false);
  call($EnableControls, true, true, false, true, true, true, false);
  call($UpdateInterface);
});
$createTuringInstructionFromTuple = new Func("createTuringInstructionFromTuple", function($tuple = null, $line = null) {
  return new Object("newSymbol", get($tuple, "newSymbol"), "action", get($tuple, "action"), "newState", get($tuple, "newState"), "sourceLineNumber", $line, "breakpoint", get($tuple, "breakpoint"));
});
$isArray = new Func("isArray", function($possiblyArr = null) use (&$Object) {
  call_method(get(get($Object, "prototype"), "toString"), "call", $possiblyArr) === "[object Array]";
});
$Compile = new Func("Compile", function() use (&$oTextarea, &$debug, &$SetSyntaxMessage, &$ClearErrorLines, &$aProgram, &$Object, &$ParseLine, &$nVariant, &$SetErrorLine, &$createTuringInstructionFromTuple, &$oRegExp, &$RegExp, &$aResult, &$parseInt, &$nDebugLevel, &$�24�, &$oPrevInstruction, &$bIsDirty, &$UpdateInterface) {
  $sSource = null; $aLines = null; $i = null; $oTuple = null; $nNewDebugLevel = null;
  $sSource = get($oTextarea, "value");
  call($debug, 2.0, "Compile()");
  call($SetSyntaxMessage, Object::$null);
  call($ClearErrorLines);
  $aProgram = _new($Object);
  $sSource = call_method($sSource, "replace", new RegExp("\\r", "g"), "");
  $aLines = call_method($sSource, "split", "\n");
  for ($i = 0.0; $i < get($aLines, "length"); $i++) {
    $oTuple = call($ParseLine, get($aLines, $i), $i);
    if (is(get($oTuple, "isValid"))) {
      call($debug, 5.0, _concat(" Parsed tuple: '", get($oTuple, "currentState"), "'  '", get($oTuple, "currentSymbol"), "'  '", get($oTuple, "newSymbol"), "'  '", get($oTuple, "action"), "'  '", get($oTuple, "newState"), "'"));
      if (eq(get($aProgram, get($oTuple, "currentState")), Object::$null)) {
        set($aProgram, get($oTuple, "currentState"), _new($Object));
      }
      if (eq(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), Object::$null)) {
        set(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol"), new Arr());
      }
      if (get(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), "length") > 0.0 && !eq($nVariant, 2.0)) {
        call($debug, 1.0, _concat("Warning: multiple definitions for state '", get($oTuple, "currentState"), "' symbol '", get($oTuple, "currentSymbol"), "' on lines ", get(get(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), 0.0), "sourceLineNumber"), 1.0, " and ", $i, 1.0));
        call($SetSyntaxMessage, _concat("Warning: Multiple definitions for state '", get($oTuple, "currentState"), "' symbol '", get($oTuple, "currentSymbol"), "' on lines ", get(get(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), 0.0), "sourceLineNumber"), 1.0, " and ", $i, 1.0));
        call($SetErrorLine, $i);
        call($SetErrorLine, get(get(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), 0.0), "sourceLineNumber"));
        set(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), 0.0, call($createTuringInstructionFromTuple, $oTuple, $i));
      } else {
        call_method(get(get($aProgram, get($oTuple, "currentState")), get($oTuple, "currentSymbol")), "push", call($createTuringInstructionFromTuple, $oTuple, $i));
      }

    } else if (is(get($oTuple, "error"))) {
      call($debug, 2.0, _concat("Syntax error: ", get($oTuple, "error")));
      call($SetSyntaxMessage, get($oTuple, "error"));
      call($SetErrorLine, $i);
    }

  }
  $oRegExp = _new($RegExp, ";.*\\\$DEBUG: *(.+)");
  $aResult = call_method($oRegExp, "exec", $sSource);
  if (!eq($aResult, Object::$null) && get($aResult, "length") >= 2.0) {
    $nNewDebugLevel = call($parseInt, get($aResult, 1.0));
    if (!eq($nNewDebugLevel, $nDebugLevel)) {
      $nDebugLevel = call($parseInt, get($aResult, 1.0));
      call($debug, 1.0, _concat("Setting debug level to ", $nDebugLevel));
      if ($nDebugLevel > 0.0) {
        call_method(call($�24�, ".DebugClass"), "toggle", true);
      }
    }
  }
  $oPrevInstruction = Object::$null;
  $bIsDirty = false;
  call($UpdateInterface);
});
$ParseLine = new Func("ParseLine", function($sLine = null, $nLineNum = null) use (&$debug, &$Object) {
  $aTokens = null; $oTuple = null;
  call($debug, 5.0, _concat("ParseLine( ", $sLine, " )"));
  $sLine = get(call_method($sLine, "split", ";", 1.0), 0.0);
  $aTokens = call_method($sLine, "split", new RegExp("\\s+", ""));
  $aTokens = call_method($aTokens, "filter", new Func(function($arg = null) {
    return !eq($arg, "");
  }));
  $oTuple = _new($Object);
  if (eq(get($aTokens, "length"), 0.0)) {
    set($oTuple, "isValid", false);
    return $oTuple;
  }
  set($oTuple, "currentState", get($aTokens, 0.0));
  if (get($aTokens, "length") < 2.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": missing <current symbol>!"));
    return $oTuple;
  }
  if (get(get($aTokens, 1.0), "length") > 1.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": <current symbol> should be a single character!"));
    return $oTuple;
  }
  set($oTuple, "currentSymbol", get($aTokens, 1.0));
  if (get($aTokens, "length") < 3.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": missing <new symbol>!"));
    return $oTuple;
  }
  if (get(get($aTokens, 2.0), "length") > 1.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": <new symbol> should be a single character!"));
    return $oTuple;
  }
  set($oTuple, "newSymbol", get($aTokens, 2.0));
  if (get($aTokens, "length") < 4.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": missing <direction>!"));
    return $oTuple;
  }
  if (call_method(new Arr("l", "r", "*"), "indexOf", call_method(get($aTokens, 3.0), "toLowerCase")) < 0.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": <direction> should be 'l', 'r' or '*'!"));
    return $oTuple;
  }
  set($oTuple, "action", call_method(get($aTokens, 3.0), "toLowerCase"));
  if (get($aTokens, "length") < 5.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": missing <new state>!"));
    return $oTuple;
  }
  set($oTuple, "newState", get($aTokens, 4.0));
  if (get($aTokens, "length") > 6.0) {
    set($oTuple, "isValid", false);
    set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": too many entries!"));
    return $oTuple;
  }
  if (eq(get($aTokens, "length"), 6.0)) {
    if (eq(get($aTokens, 5.0), "!")) {
      set($oTuple, "breakpoint", true);
    } else {
      set($oTuple, "isValid", false);
      set($oTuple, "error", _concat("Syntax error on line ", $nLineNum, 1.0, ": too many entries!"));
      return $oTuple;
    }

  } else {
    set($oTuple, "breakpoint", false);
  }

  set($oTuple, "isValid", true);
  return $oTuple;
});
$GetNextInstructions = new Func("GetNextInstructions", function($sState = null, $sHeadSymbol = null) use (&$aProgram) {
  $result = null;
  $result = Object::$null;
  if (!eq(get($aProgram, $sState), Object::$null) && !eq(get(get($aProgram, $sState), $sHeadSymbol), Object::$null)) {
    return get(get($aProgram, $sState), $sHeadSymbol);
  } else if (!eq(get($aProgram, $sState), Object::$null) && !eq(get(get($aProgram, $sState), "*"), Object::$null)) {
    return get(get($aProgram, $sState), "*");
  } else if (!eq(get($aProgram, "*"), Object::$null) && !eq(get(get($aProgram, "*"), $sHeadSymbol), Object::$null)) {
    return get(get($aProgram, "*"), $sHeadSymbol);
  } else if (!eq(get($aProgram, "*"), Object::$null) && !eq(get(get($aProgram, "*"), "*"), Object::$null)) {
    return get(get($aProgram, "*"), "*");
  } else {
    return new Arr();
  }




});
$GetTapeSymbol = new Func("GetTapeSymbol", function($n = null) use (&$nTapeOffset, &$sTape, &$debug) {
  $c = null;
  if ($n < $nTapeOffset || $n >= _plus(get($sTape, "length"), $nTapeOffset)) {
    call($debug, 4.0, _concat("GetTapeSymbol( ", $n, " ) = '", $c, "'   outside sTape range"));
    return "_";
  } else {
    $c = call_method($sTape, "charAt", to_number($n) - to_number($nTapeOffset));
    if (eq($c, " ")) {
      $c = "_";
      call($debug, 4.0, "Warning: GetTapeSymbol() got SPACE not _ !");
    }
    call($debug, 4.0, _concat("GetTapeSymbol( ", $n, " ) = '", $c, "'"));
    return $c;
  }

});
$SetTapeSymbol = new Func("SetTapeSymbol", function($n = null, $c = null) use (&$debug, &$nTapeOffset, &$sTape, &$repeat) {
  call($debug, 4.0, _concat("SetTapeSymbol( ", $n, ", ", $c, " ); sTape = '", $sTape, "' nTapeOffset = ", $nTapeOffset));
  if (eq($c, " ")) {
    $c = "_";
    call($debug, 4.0, "Warning: SetTapeSymbol() with SPACE not _ !");
  }
  if ($n < $nTapeOffset) {
    $sTape = _plus($c, call($repeat, "_", to_number((to_number($nTapeOffset) - to_number($n))) - 1.0), $sTape);
    $nTapeOffset = $n;
  } else if ($n > _plus($nTapeOffset, get($sTape, "length"))) {
    $sTape = _plus($sTape, call($repeat, "_", to_number((to_number(_plus($nTapeOffset, get($sTape, "length"))) - to_number($n))) - 1.0), $c);
  } else {
    $sTape = _plus(call_method($sTape, "substr", 0.0, to_number($n) - to_number($nTapeOffset)), $c, call_method($sTape, "substr", _plus((to_number($n) - to_number($nTapeOffset)), 1.0)));
  }


});
$SaveMachineSnapshot = new Func("SaveMachineSnapshot", function() use (&$sState, &$sTape, &$nTapeOffset, &$nHeadPosition, &$nSteps, &$bFullSpeed, &$nVariant, &$oTextarea, &$�24�) {
  return new Object("program", get($oTextarea, "value"), "state", $sState, "tape", $sTape, "tapeoffset", $nTapeOffset, "headposition", $nHeadPosition, "steps", $nSteps, "initialtape", get(get(call($�24�, "#InitialInput"), 0.0), "value"), "initialstate", get(get(call($�24�, "#InitialState"), 0.0), "value"), "fullspeed", $bFullSpeed, "variant", $nVariant, "version", 1.0);
});
$LoadMachineSnapshot = new Func("LoadMachineSnapshot", function($oObj = null) use (&$debug, &$oTextarea, &$sState, &$sTape, &$nTapeOffset, &$nHeadPosition, &$nSteps, &$�24�, &$bFullSpeed, &$nVariant, &$VariantChanged, &$SetupVariantCSS, &$aUndoList, &$SetStatusMessage, &$EnableControls, &$TextareaChanged, &$Compile, &$UpdateInterface) {
  if (is(get($oObj, "version")) && !eq(get($oObj, "version"), 1.0)) {
    call($debug, 1.0, _concat("Warning: saved machine has unknown version number ", get($oObj, "version")));
  }
  if (is(get($oObj, "program"))) {
    set($oTextarea, "value", get($oObj, "program"));
  }
  if (is(get($oObj, "state"))) {
    $sState = get($oObj, "state");
  }
  if (is(get($oObj, "tape"))) {
    $sTape = get($oObj, "tape");
  }
  if (is(get($oObj, "tapeoffset"))) {
    $nTapeOffset = get($oObj, "tapeoffset");
  }
  if (is(get($oObj, "headposition"))) {
    $nHeadPosition = get($oObj, "headposition");
  }
  if (is(get($oObj, "steps"))) {
    $nSteps = get($oObj, "steps");
  }
  if (is(get($oObj, "initialtape"))) {
    set(get(call($�24�, "#InitialInput"), 0.0), "value", get($oObj, "initialtape"));
  }
  if (is(get($oObj, "initialstate"))) {
    set(get(call($�24�, "#InitialState"), 0.0), "value", get($oObj, "initialstate"));
  } else {
    set(get(call($�24�, "#InitialState"), 0.0), "value", "");
  }

  if (is(get($oObj, "fullspeed"))) {
    set(get(call($�24�, "#SpeedCheckbox"), 0.0), "checked", get($oObj, "fullspeed"));
    $bFullSpeed = get($oObj, "fullspeed");
  }
  if (is(get($oObj, "variant"))) {
    $nVariant = get($oObj, "variant");
  } else {
    $nVariant = 0.0;
  }

  call_method(call($�24�, "#MachineVariant"), "val", $nVariant);
  call($VariantChanged, false);
  call($SetupVariantCSS);
  $aUndoList = new Arr();
  if (eq(call_method(call_method($sState, "substring", 0.0, 4.0), "toLowerCase"), "halt")) {
    call($SetStatusMessage, "Machine loaded. Halted.", 1.0);
    call($EnableControls, false, false, false, true, true, true, true);
  } else {
    call($SetStatusMessage, "Machine loaded and ready", 1.0);
    call($EnableControls, true, true, false, true, true, true, true);
  }

  call($TextareaChanged);
  call($Compile);
  call($UpdateInterface);
});
$SetStatusMessage = new Func("SetStatusMessage", function($sString = null, $nBgFlash = null) use (&$�24�, &$sPreviousStatusMsg) {
  call_method(call($�24�, "#MachineStatusMsgText"), "text", $sString);
  if ($nBgFlash > 0.0) {
    call_method(call_method(call_method(call_method(call($�24�, "#MachineStatusMsgBg"), "stop", true, true), "css", "background-color", eq($nBgFlash, 1.0) ? "#c9f2c9" : "#ffb3b3"), "show"), "fadeOut", 600.0);
  }
  if (!eq($sString, "") && eq($sPreviousStatusMsg, $sString) && !eq($nBgFlash, -1.0)) {
    call_method(call_method(call_method(call_method(call($�24�, "#MachineStatusMsgBg"), "stop", true, true), "css", "background-color", "#bbf8ff"), "show"), "fadeOut", 600.0);
  }
  if (!eq($sString, "")) {
    $sPreviousStatusMsg = $sString;
  }
});
$SetSyntaxMessage = new Func("SetSyntaxMessage", function($msg = null) use (&$�24�) {
  call_method(call($�24�, "#SyntaxMsg"), "text", is($msg) ? $msg : "");
});
$RenderTape = new Func("RenderTape", function() use (&$nHeadPosition, &$nTapeOffset, &$debug, &$sTape, &$repeat, &$�24�) {
  $nTranslatedHeadPosition = null; $sFirstPart = null; $sHeadSymbol = null; $sSecondPart = null;
  $nTranslatedHeadPosition = to_number($nHeadPosition) - to_number($nTapeOffset);
  call($debug, 4.0, _concat("RenderTape: translated head pos: ", $nTranslatedHeadPosition, "  head pos: ", $nHeadPosition, "  tape offset: ", $nTapeOffset));
  call($debug, 4.0, _concat("RenderTape: sTape = '", $sTape, "'"));
  if ($nTranslatedHeadPosition > 0.0) {
    $sFirstPart = call_method($sTape, "substr", 0.0, $nTranslatedHeadPosition);
  } else {
    $sFirstPart = "";
  }

  if ($nTranslatedHeadPosition > get($sTape, "length")) {
    $sFirstPart += call($repeat, " ", to_number($nTranslatedHeadPosition) - to_number(get($sTape, "length")));
  }
  $sFirstPart = call_method($sFirstPart, "replace", new RegExp("_", "g"), " ");
  if ($nTranslatedHeadPosition >= 0.0 && $nTranslatedHeadPosition < get($sTape, "length")) {
    $sHeadSymbol = call_method($sTape, "charAt", $nTranslatedHeadPosition);
  } else {
    $sHeadSymbol = " ";
  }

  $sHeadSymbol = call_method($sHeadSymbol, "replace", new RegExp("_", "g"), " ");
  if ($nTranslatedHeadPosition >= 0.0 && $nTranslatedHeadPosition < (to_number(get($sTape, "length")) - 1.0)) {
    $sSecondPart = call_method($sTape, "substr", _plus($nTranslatedHeadPosition, 1.0));
  } else if ($nTranslatedHeadPosition < 0.0) {
    $sSecondPart = _plus(call($repeat, " ", to_number(_negate($nTranslatedHeadPosition)) - 1.0), $sTape);
  } else {
    $sSecondPart = "";
  }


  $sSecondPart = call_method($sSecondPart, "replace", new RegExp("_", "g"), " ");
  call($debug, 4.0, _concat("RenderTape: sFirstPart = '", $sFirstPart, "' sHeadSymbol = '", $sHeadSymbol, "'  sSecondPart = '", $sSecondPart, "'"));
  call_method(call($�24�, "#LeftTape"), "text", $sFirstPart);
  call_method(call($�24�, "#ActiveTape"), "text", $sHeadSymbol);
  call_method(call($�24�, "#RightTape"), "text", $sSecondPart);
  if (get(call_method(call($�24�, "#ActiveTapeArea"), "position"), "left") < 0.0) {
    call_method(call($�24�, "#MachineTape"), "scrollLeft", to_number(_plus(call_method(call($�24�, "#MachineTape"), "scrollLeft"), get(call_method(call($�24�, "#ActiveTapeArea"), "position"), "left"))) - 10.0);
  } else if (_plus(get(call_method(call($�24�, "#ActiveTapeArea"), "position"), "left"), call_method(call($�24�, "#ActiveTapeArea"), "width")) > call_method(call($�24�, "#MachineTape"), "width")) {
    call_method(call($�24�, "#MachineTape"), "scrollLeft", _plus(call_method(call($�24�, "#MachineTape"), "scrollLeft"), (to_number(get(call_method(call($�24�, "#ActiveTapeArea"), "position"), "left")) - to_number(call_method(call($�24�, "#MachineTape"), "width"))), 10.0));
  }

});
$RenderState = new Func("RenderState", function() use (&$sState, &$�24�) {
  call_method(call($�24�, "#MachineState"), "text", $sState);
});
$RenderSteps = new Func("RenderSteps", function() use (&$nSteps, &$�24�) {
  call_method(call($�24�, "#MachineSteps"), "text", $nSteps);
});
$RenderLineMarkers = new Func("RenderLineMarkers", function() use (&$�24�, &$GetNextInstructions, &$sState, &$GetTapeSymbol, &$nHeadPosition, &$debug, &$oPrevInstruction, &$SetActiveLines) {
  $oNextList = null;
  $oNextList = call_method($�24�, "map", call($GetNextInstructions, $sState, call($GetTapeSymbol, $nHeadPosition)), new Func(function($x = null) {
    return get($x, "sourceLineNumber");
  }));
  call($debug, 3.0, _concat("Rendering line markers: ", $oNextList, " ", is($oPrevInstruction) ? get($oPrevInstruction, "sourceLineNumber") : -1.0));
  call($SetActiveLines, $oNextList, is($oPrevInstruction) ? get($oPrevInstruction, "sourceLineNumber") : -1.0);
});
$UpdateInterface = new Func("UpdateInterface", function() use (&$RenderTape, &$RenderState, &$RenderSteps, &$RenderLineMarkers) {
  call($RenderTape);
  call($RenderState);
  call($RenderSteps);
  call($RenderLineMarkers);
});
$ClearDebug = new Func("ClearDebug", function() use (&$�24�) {
  call_method(call($�24�, "#debug"), "empty");
});
$EnableControls = new Func("EnableControls", function($bStep = null, $bRun = null, $bStop = null, $bReset = null, $bSpeed = null, $bTextarea = null, $bUndo = null) use (&$document, &$EnableUndoButton, &$�24�) {
  set(call_method($document, "getElementById", "StepButton"), "disabled", not($bStep));
  set(call_method($document, "getElementById", "RunButton"), "disabled", not($bRun));
  set(call_method($document, "getElementById", "StopButton"), "disabled", not($bStop));
  set(call_method($document, "getElementById", "ResetButton"), "disabled", not($bReset));
  set(call_method($document, "getElementById", "SpeedCheckbox"), "disabled", not($bSpeed));
  set(call_method($document, "getElementById", "Source"), "disabled", not($bTextarea));
  call($EnableUndoButton, $bUndo);
  if (is($bSpeed)) {
    call_method(call($�24�, "#SpeedCheckboxLabel"), "removeClass", "disabled");
  } else {
    call_method(call($�24�, "#SpeedCheckboxLabel"), "addClass", "disabled");
  }

});
$EnableUndoButton = new Func("EnableUndoButton", function($bUndo = null) use (&$document, &$aUndoList) {
  set(call_method($document, "getElementById", "UndoButton"), "disabled", not((is($and_ = $bUndo) ? get($aUndoList, "length") > 0.0 : $and_)));
});
$StepButton = new Func("StepButton", function() use (&$SetStatusMessage, &$Step, &$EnableUndoButton) {
  call($SetStatusMessage, "", -1.0);
  call($Step);
  call($EnableUndoButton, true);
});
$RunButton = new Func("RunButton", function() use (&$SetStatusMessage, &$SpeedCheckbox, &$EnableControls, &$Run) {
  call($SetStatusMessage, "Running...");
  call($SpeedCheckbox);
  call($EnableControls, false, false, true, false, false, false, false);
  call($Run);
});
$StopButton = new Func("StopButton", function() use (&$hRunTimer, &$SetStatusMessage, &$EnableControls, &$StopTimer) {
  if (!eq($hRunTimer, Object::$null)) {
    call($SetStatusMessage, "Paused; click 'Run' or 'Step' to resume.");
    call($EnableControls, true, true, false, true, true, true, true);
    call($StopTimer);
  }
});
$ResetButton = new Func("ResetButton", function() use (&$SetStatusMessage, &$Reset, &$EnableControls) {
  call($SetStatusMessage, "Machine reset. Click 'Run' or 'Step' to start.");
  call($Reset);
  call($EnableControls, true, true, false, true, true, true, false);
});
$SpeedCheckbox = new Func("SpeedCheckbox", function() use (&$bFullSpeed, &$�24�) {
  $bFullSpeed = get(get(call($�24�, "#SpeedCheckbox"), 0.0), "checked");
});
$VariantChanged = new Func("VariantChanged", function($needWarning = null) use (&$�24�, &$Number, &$ShowResetMsg) {
  $dropdown = null; $selected = null; $descriptions = null;
  $dropdown = get(call($�24�, "#MachineVariant"), 0.0);
  $selected = call($Number, get(get(get($dropdown, "options"), get($dropdown, "selectedIndex")), "value"));
  $descriptions = new Object("0", "Standard Turing machine with tape infinite in both directions", "1", "Turing machine with tape infinite in one direction only (as used in, eg, <a href='http://math.mit.edu/~sipser/book.html'>Sipser</a>)", "2", "Non-deterministic Turing machine which allows multiple rules for the same state and symbol pair, and chooses one at random");
  call_method(call($�24�, "#MachineVariantDescription"), "html", get($descriptions, $selected));
  if (is($needWarning)) {
    call($ShowResetMsg, true);
  }
});
$SetupVariantCSS = new Func("SetupVariantCSS", function() use (&$nVariant, &$�24�) {
  if (eq($nVariant, 1.0)) {
    call_method(call($�24�, "#LeftTape"), "addClass", "OneDirectionalTape");
  } else {
    call_method(call($�24�, "#LeftTape"), "removeClass", "OneDirectionalTape");
  }

});
$ShowResetMsg = new Func("ShowResetMsg", function($b = null) use (&$�24�) {
  if (is($b)) {
    call_method(call($�24�, "#ResetMessage"), "fadeIn");
    call_method(call($�24�, "#ResetButton"), "addClass", "glow");
  } else {
    call_method(call($�24�, "#ResetMessage"), "hide");
    call_method(call($�24�, "#ResetButton"), "removeClass", "glow");
  }

});
$LoadFromCloud = new Func("LoadFromCloud", function($sID = null) use (&$�24�, &$loadSuccessCallback, &$loadErrorCallback) {
  $n = null;
  $n = call_method($sID, "indexOf", "&");
  $sID = call_method($sID, "substring", 0.0, !eq($n, -1.0) ? $n : get($sID, "length"));
  call_method($�24�, "ajax", new Object("url", _concat("https://api.github.com/gists/", $sID), "type", "GET", "dataType", "json", "success", $loadSuccessCallback, "error", $loadErrorCallback));
});
$loadSuccessCallback = new Func("loadSuccessCallback", function($oData = null) use (&$debug, &$SetStatusMessage, &$JSON, &$LoadMachineSnapshot) {
  $oUnpackedObject = null;
  if (not($oData) || not(get($oData, "files")) || not(get(get($oData, "files"), "machine.json")) || not(get(get(get($oData, "files"), "machine.json"), "content"))) {
    call($debug, 1.0, "Error: Load AJAX request succeeded but can't find expected data.");
    call($SetStatusMessage, "Error loading saved machine :(", 2.0);
    return ;
  }
  try {
    $oUnpackedObject = call_method($JSON, "parse", get(get(get($oData, "files"), "machine.json"), "content"));
  } catch(Exception $e_1_) {
    if ($e_1_ instanceof Ex) $e_1_ = $e_1_->value;
    call($debug, 1.0, _concat("Error: Exception when unpacking JSON: ", $e_1_));
    call($SetStatusMessage, "Error loading saved machine :(", 2.0);
    return ;
  }
  call($LoadMachineSnapshot, $oUnpackedObject);
});
$loadErrorCallback = new Func("loadErrorCallback", function($oData = null, $sStatus = null, $oRequestObj = null) use (&$debug, &$SetStatusMessage) {
  call($debug, 1.0, _concat("Error: Load failed. AJAX request to Github failed. HTTP response ", $oRequestObj));
  call($SetStatusMessage, "Error loading saved machine :(", 2.0);
});
$SaveToCloud = new Func("SaveToCloud", function() use (&$SetSaveMessage, &$SaveMachineSnapshot, &$�24�, &$saveSuccessCallback, &$saveErrorCallback, &$JSON) {
  $oState = null; $ajaxresult = null;
  call($SetSaveMessage, "Saving...", Object::$null);
  $oState = call($SaveMachineSnapshot);
  $ajaxresult = call_method($�24�, "ajax", new Object("url", "save.php", "type", "POST", "data", call_method($JSON, "stringify", $oState), "dataType", "json", "contentType", "application/json; charset=utf-8", "success", $saveSuccessCallback, "error", $saveErrorCallback));
});
$saveSuccessCallback = new Func("saveSuccessCallback", function($oData = null) use (&$window, &$debug, &$Date, &$SetSaveMessage) {
  $sURL = null; $oNow = null; $sTimestamp = null;
  if (is($oData) && is(get($oData, "id"))) {
    $sURL = call_method(get(get($window, "location"), "href"), "replace", new RegExp("[\\#\\?].*", ""), "");
    $sURL += _concat("?", get($oData, "id"));
    call($debug, 1.0, _concat("Save successful. Gist ID is ", get($oData, "id"), " Gist URL is ", get($oData, "url")));
    $oNow = _new($Date);
    $sTimestamp = _concat(call_method($oNow, "getHours") < 10.0 ? _concat("0", call_method($oNow, "getHours")) : call_method($oNow, "getHours"), ":", call_method($oNow, "getMinutes") < 10.0 ? _concat("0", call_method($oNow, "getMinutes")) : call_method($oNow, "getMinutes"), ":", call_method($oNow, "getSeconds") < 10.0 ? _concat("0", call_method($oNow, "getSeconds")) : call_method($oNow, "getSeconds"));
    call($SetSaveMessage, _concat("Saved! Your URL is <br><a href=", $sURL, ">", $sURL, "</a><br>Bookmark or share this link to access your saved machine.<br><span style='font-size: small; font-style: italic;'>Last saved at ", $sTimestamp, "</span>"), 1.0);
  } else {
    call($debug, 1.0, "Error: Save failed. Missing data or id from Github response.");
    call($SetSaveMessage, "Save failed, sorry :(", 2.0);
  }

});
$saveErrorCallback = new Func("saveErrorCallback", function($oData = null, $sStatus = null, $oRequestObj = null) use (&$debug, &$SetSaveMessage) {
  call($debug, 1.0, _concat("Error: Save failed. AJAX request to Github failed. HTTP response ", $oRequestObj));
  call($SetSaveMessage, "Save failed, sorry :(", 2.0);
});
$SetSaveMessage = new Func("SetSaveMessage", function($sStr = null, $nBgFlash = null) use (&$�24�) {
  call_method(call($�24�, "#SaveStatusMsg"), "html", $sStr);
  call_method(call($�24�, "#SaveStatus"), "slideDown");
  if (is($nBgFlash)) {
    call_method(call_method(call_method(call_method(call($�24�, "#SaveStatusBg"), "stop", true, true), "css", "background-color", eq($nBgFlash, 1.0) ? "#88ee99" : "#eb8888"), "show"), "fadeOut", 800.0);
  }
});
$ClearSaveMessage = new Func("ClearSaveMessage", function() use (&$�24�) {
  call_method(call($�24�, "#SaveStatusMsg"), "empty");
  call_method(call($�24�, "#SaveStatus"), "hide");
});
$LoadSampleProgram = new Func("LoadSampleProgram", function($zName = null, $zFriendlyName = null, $bInitial = null) use (&$debug, &$SetStatusMessage, &$StopTimer, &$�24�, &$ClearSaveMessage, &$RegExp, &$nVariant, &$VariantChanged, &$oTextarea, &$TextareaChanged, &$Compile, &$Reset) {
  $zFileName = null;
  call($debug, 1.0, _concat("Load '", $zName, "'"));
  call($SetStatusMessage, "Loading sample program...");
  $zFileName = _concat("machines/", $zName, ".txt");
  call($StopTimer);
  call_method($�24�, "ajax", new Object("url", $zFileName, "type", "GET", "dataType", "text", "success", new Func(function($sData = null, $sStatus = null, $oRequestObj = null) use (&$RegExp, &$debug, &$�24�, &$nVariant, &$VariantChanged, &$oTextarea, &$TextareaChanged, &$Compile, &$Reset, &$bInitial, &$SetStatusMessage, &$zFriendlyName) {
    $oRegExp = null; $aRegexpResult = null;
    $oRegExp = _new($RegExp, ";.*\\\$INITIAL_TAPE:? *(.+)\$");
    $aRegexpResult = call_method($oRegExp, "exec", $sData);
    if (!eq($aRegexpResult, Object::$null) && get($aRegexpResult, "length") >= 2.0) {
      call($debug, 4.0, _concat("Parsed initial tape: '", $aRegexpResult, "' length: ", eq($aRegexpResult, Object::$null) ? "null" : get($aRegexpResult, "length")));
      set(get(call($�24�, "#InitialInput"), 0.0), "value", get($aRegexpResult, 1.0));
      $sData = call_method($sData, "replace", new RegExp("^.*\\\$INITIAL_TAPE:.*\$", "m"), "");
    }
    set(get(call($�24�, "#InitialState"), 0.0), "value", "0");
    $nVariant = 0.0;
    call_method(call($�24�, "#MachineVariant"), "val", 0.0);
    call($VariantChanged, false);
    set($oTextarea, "value", $sData);
    call($TextareaChanged);
    call($Compile);
    call($Reset);
    if (not($bInitial)) {
      call($SetStatusMessage, _concat($zFriendlyName, " successfully loaded"), 1.0);
    }
  }), "error", new Func(function($oData = null, $sStatus = null, $oRequestObj = null) use (&$debug, &$SetStatusMessage, &$zFriendlyName) {
    call($debug, 1.0, _concat("Error: Load failed. HTTP response ", get($oRequestObj, "status"), " ", get($oRequestObj, "statusText")));
    call($SetStatusMessage, _concat("Error loading ", $zFriendlyName, " :("), 2.0);
  })));
  call_method(call($�24�, "#LoadMenu"), "slideUp");
  call($ClearSaveMessage);
});
$TextareaChanged = new Func("TextareaChanged", function() use (&$oTextarea, &$nTextareaLines, &$UpdateTextareaDecorations, &$bIsDirty, &$oPrevInstruction, &$RenderLineMarkers) {
  $nNewLines = null;
  $nNewLines = _plus(is(call_method(get($oTextarea, "value"), "match", new RegExp("\\n", "g"))) ? get(call_method(get($oTextarea, "value"), "match", new RegExp("\\n", "g")), "length") : 0.0, 1.0);
  if (!eq($nNewLines, $nTextareaLines)) {
    $nTextareaLines = $nNewLines;
    call($UpdateTextareaDecorations);
  }
  $bIsDirty = true;
  $oPrevInstruction = Object::$null;
  call($RenderLineMarkers);
});
$UpdateTextareaDecorations = new Func("UpdateTextareaDecorations", function() use (&$�24�, &$oTextarea, &$UpdateTextareaScroll) {
  $oBackgroundDiv = null; $sSource = null; $aLines = null; $i = null;
  $oBackgroundDiv = call($�24�, "#SourceBackground");
  call_method($oBackgroundDiv, "empty");
  $sSource = get($oTextarea, "value");
  $sSource = call_method($sSource, "replace", new RegExp("\\r", "g"), "");
  $aLines = call_method($sSource, "split", "\n");
  for ($i = 0.0; $i < get($aLines, "length"); $i++) {
    call_method($oBackgroundDiv, "append", call($�24�, _concat("<div id='talinebg", $i, 1.0, "' class='talinebg'><div class='talinenum'>", $i, 1.0, "</div></div>")));
  }
  call($UpdateTextareaScroll);
});
$SetActiveLines = new Func("SetActiveLines", function($next = null, $prev = null) use (&$�24�) {
  $shift = null; $i = null; $oMarker = null;
  call_method(call($�24�, ".talinebgnext"), "removeClass", "talinebgnext");
  call_method(call($�24�, ".NextLineMarker"), "remove");
  call_method(call($�24�, ".talinebgprev"), "removeClass", "talinebgprev");
  call_method(call($�24�, ".PrevLineMarker"), "remove");
  $shift = false;
  for ($i = 0.0; $i < get($next, "length"); $i++) {
    $oMarker = call($�24�, "<div class='NextLineMarker'>Next<div class='NextLineMarkerEnd'></div></div>");
    call_method(call_method(call($�24�, _concat("#talinebg", get($next, $i), 1.0)), "addClass", "talinebgnext"), "prepend", $oMarker);
    if (eq(get($next, $i), $prev)) {
      call_method($oMarker, "addClass", "shifted");
      $shift = true;
    }
  }
  if ($prev >= 0.0) {
    $oMarker = call($�24�, "<div class='PrevLineMarker'>Prev<div class='PrevLineMarkerEnd'></div></div>");
    if (is($shift)) {
      call_method(call($�24�, _concat("#talinebg", $prev, 1.0)), "prepend", $oMarker);
      call_method($oMarker, "addClass", "shifted");
    } else {
      call_method(call_method(call($�24�, _concat("#talinebg", $prev, 1.0)), "addClass", "talinebgprev"), "prepend", $oMarker);
    }

  }
});
$SetErrorLine = new Func("SetErrorLine", function($num = null) use (&$�24�) {
  call_method(call($�24�, _concat("#talinebg", $num, 1.0)), "addClass", "talinebgerror");
});
$ClearErrorLines = new Func("ClearErrorLines", function() use (&$�24�) {
  call_method(call($�24�, ".talinebg"), "removeClass", "talinebgerror");
});
$UpdateTextareaScroll = new Func("UpdateTextareaScroll", function() use (&$�24�, &$oTextarea) {
  $oBackgroundDiv = null;
  $oBackgroundDiv = call($�24�, "#SourceBackground");
  call_method(call($�24�, $oBackgroundDiv), "css", new Object("margin-top", _concat((-1.0 * call_method(call($�24�, $oTextarea), "scrollTop")), "px")));
});
$AboutMenuClicked = new Func("AboutMenuClicked", function($name = null) use (&$�24�) {
  call_method(call($�24�, ".AboutItem"), "css", "font-weight", "normal");
  call_method(call($�24�, _concat("#AboutItem", $name)), "css", "font-weight", "bold");
  call_method(call_method(call($�24�, ".AboutContent"), "slideUp", new Object("queue", false, "duration", 150.0)), "fadeOut", 150.0);
  call_method(call_method(call_method(call_method(call_method(call_method(call($�24�, _concat("#AboutContent", $name)), "stop"), "detach"), "prependTo", "#AboutContentContainer"), "fadeIn", new Object("queue", false, "duration", 150.0)), "css", "display", "none"), "slideDown", 150.0);
});
$OnLoad = new Func("OnLoad", function() use (&$nDebugLevel, &$�24�, &$isOldIE, &$debug, &$TextareaChanged, &$oTextarea, &$VariantChanged, &$window, &$SetStatusMessage, &$LoadFromCloud, &$LoadSampleProgram) {
  if ($nDebugLevel > 0.0) {
    call_method(call($�24�, ".DebugClass"), "toggle", true);
  }
  if (!eq(_typeof($isOldIE), "undefined")) {
    call($debug, 1.0, "Old version of IE detected, adding extra textarea events");
    call_method(call($�24�, "#Source"), "on", "keypress change", $TextareaChanged);
  }
  $oTextarea = get(call($�24�, "#Source"), 0.0);
  call($TextareaChanged);
  call($VariantChanged, false);
  if (!eq(get(get($window, "location"), "search"), "")) {
    call($SetStatusMessage, "Loading saved machine...");
    call($LoadFromCloud, call_method(get(get($window, "location"), "search"), "substring", 1.0));
    call_method(get($window, "history"), "replaceState", Object::$null, "", get(get($window, "location"), "pathname"));
  } else {
    call($LoadSampleProgram, "palindrome", "Default program", true);
    call($SetStatusMessage, "Load or write a Turing machine program and click Run!");
  }

});
$testsave = new Func("testsave", function($success = null) use (&$saveSuccessCallback, &$�24�, &$saveErrorCallback) {
  if (is($success)) {
    call($saveSuccessCallback, new Object("id", _concat("!!!WHACK!!!", call_method($�24�, "now")), "url", "http://wha.ck/xxx"));
  } else {
    call($saveErrorCallback, new Object("id", _concat("!!!WHACK!!!", call_method($�24�, "now")), "url", "http://wha.ck/xxx"), Object::$null, new Object("status", -1.0, "statusText", "dummy"));
  }

});
$repeat = new Func("repeat", function($c = null, $n = null) {
  $sTmp = null;
  $sTmp = "";
  while ($n-- > 0.0) {
    $sTmp += $c;
  }
  return $sTmp;
});
$debug = new Func("debug", function($n = null, $str = null) use (&$SetStatusMessage, &$console, &$nDebugLevel, &$�24�, &$document) {
  if ($n <= 0.0) {
    call($SetStatusMessage, $str);
    call_method($console, "log", $str);
  }
  if ($nDebugLevel >= $n) {
    call_method(call($�24�, "#debug"), "append", call_method($document, "createTextNode", _concat($str, "\n")));
    call_method($console, "log", $str);
  }
});
$nDebugLevel = 0.0;
$bFullSpeed = false;
$bIsReset = false;
$sTape = "";
$nTapeOffset = 0.0;
$nHeadPosition = 0.0;
$sState = "0";
$nSteps = 0.0;
$nVariant = 0.0;
$hRunTimer = Object::$null;
$aProgram = _new($Object);
$nMaxUndo = 10.0;
$aUndoList = new Arr();
$nTextareaLines = -1.0;
$bIsDirty = true;
$oNextLineMarker = call($�24�, "<div class='NextLineMarker'>Next<div class='NextLineMarkerEnd'></div></div>");
$oPrevLineMarker = call($�24�, "<div class='PrevLineMarker'>Prev<div class='PrevLineMarkerEnd'></div></div>");
$oPrevInstruction = Object::$null;
$sPreviousStatusMsg = "";
