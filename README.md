<div dir=rtl>

# تاوتۆکەرێکی بچووکی لیسپ لە ٤٦٢ پیت‌دا بە زمانی PHP

</div>

```
for(;;)echo print_r(E(@T(preg_split("/(\(|\))| /",readline(),-1,3)),$E),1),"\n";function T(&$T){if(($t=array_shift($T))!="(")return$t;$L=[];while($T[0]!=")")$L[]=T($T);array_shift($T);return$L;}function E($X,&$E){if(!is_array($X))return$X&&@$E[$X]?$E[$X]:(@$E[0]?E($X,$E[0]):$X);elseif("def"==$X[0])return$E[$X[1]]=E($X[2],$E);elseif("fn"==$X[0])return[$X[1],$X[2],[&$E]];$P=E($X[0],$E);$F=[$P[2]];foreach($P[0]as$i=>$f)$F[$f]=E($X[$i+1],$E);return E($P[1],$F);}
```
