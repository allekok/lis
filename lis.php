<?php
/*
   A Lisp Interpreter Inspired by Norvig's lispy: https://norvig.com/lispy.html 
   Copyright (C) 2020 allekok.
   Author: Payam <payambapiri.97@gmail.com>
   License: MIT License 
 */

repl("> ");

/* Functions */
function read_from_tokens (&$tokens) {
	if(!$tokens) return;
	$token = array_shift($tokens);
	if($token == "(") {
		$L = [];
		while($tokens && $tokens[0] != ")")
			$L[] = read_from_tokens($tokens);
		array_shift($tokens);
		return $L;
	}
	elseif($token == ")") return;
	else return $token;
}
function get_env ($k, $env) {
	if(isset($env[$k])) return $env[$k];
	elseif(isset($env["parent"])) return get_env($k, $env["parent"]);
	return $k;
}
function _read ($prompt) {
	readline_add_history($str = readline($prompt));
	$tokens = preg_split("/\s+/u",
			     str_replace(["(",")"], [" ( ", " ) "], $str),
			    -1, PREG_SPLIT_NO_EMPTY);
	return read_from_tokens($tokens);
}
function _eval ($exp, &$env) {
	if(!is_array($exp))
		return get_env($exp, $env);
	elseif("label" == $exp[0])
		return $env[$exp[1]] = _eval($exp[2], $env);
	elseif("lambda" == $exp[0])
		return ["closure", ["parent" => &$env], $exp[1], $exp[2]];
	else { /* Apply */
		foreach($exp as $i => $o)
			$exp[$i] = _eval($o, $env);
		$proc = $exp[0];
		if($proc[0] != "closure") return $exp;
		foreach($proc[2] as $i => $f)
			$proc[1][$f] = $exp[$i+1];
		return _eval($proc[3], $proc[1]);
	}
}
function _print ($x) {
	if(is_array($x)) print_r($x);
	else echo "$x\n";
}
function repl ($prompt, $env=[]) {
	for(;;)	_print(_eval(_read($prompt), $env));
}
?>
