<?php
repl("> ");

function _read($prompt) {
	$tokens = preg_split(
		"/\s+/", preg_replace("/([\(\)])/", " $1 ", readline($prompt)),
		-1, PREG_SPLIT_NO_EMPTY);
	return read_from_tokens($tokens);
}
function read_from_tokens(&$tokens) {
	$token = array_shift($tokens);
	if($token == "(") {
		$L = [];
		while($tokens[0] != ")")
			$L[] = read_from_tokens($tokens);
		array_shift($tokens);
		return $L;
	}
	return $token;
}
function _eval($E, &$A) {
	if(!is_array($E))
		return get($E, $A);
	elseif("label" == $E[0])
		return $A[$E[1]] = _eval($E[2], $A);
	elseif("lambda" == $E[0])
		return [$E[1], $E[2], ["dad" => &$A]];
	$E[0] = _eval($E[0], $A);
	foreach($E[0][0] as $i => $f)
	$E[0][2][$f] = _eval($E[$i + 1], $A);
	return _eval($E[0][1], $E[0][2]);
}
function get($K, $A) {
	return @($A[$K] ? $A[$K] : ($A["dad"] ? get($K, $A["dad"]) : $K));
}
function _print($x) {
	is_array($x) ? print_r($x) : print("$x\n");
}
function repl($prompt, $A=[]) {
	for(;;)	_print(_eval(_read($prompt), $A));
}
?>
