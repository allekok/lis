<?php L("> ");
function T(&$T) {
	if(($t = array_shift($T)) != "(") return $t;
	while($T[0] != ")") $L[] = T($T);
	array_shift($T);
	return $L;
}
function R($P) { return @T(preg_split("/(\(|\))| /", readline($P), -1, 3)); }
function E($X, &$E) {
	if(!is_array($X))
		return @$E[$X] ? $E[$X] : (@$E[".."] ? E($X, $E[".."]) : $X);
	elseif("label" == $X[0]) return $E[$X[1]] = E($X[2], $E);
	elseif("lambda" == $X[0]) return [$X[1], $X[2], [".." => &$E]];
	$X[0] = E($X[0], $E);
	foreach($X[0][0] as $i => $f) $X[0][2][$f] = E($X[$i + 1], $E);
	return E($X[0][1], $X[0][2]);
}
function L($P, $E=[]) { for(;;) echo print_r(E(R($P),$E), 1), "\n"; }
