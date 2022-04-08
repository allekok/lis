<div dir=rtl>

# تاوتۆکەرێکی بچووکی لیسپ
## `PHP`
ئەژماری پیتەکان: ٣٥٧

</div>

```
for(;;)echo print_r(E(@T(preg_split("/(\(|\))| /",readline(),-1,3)),$E),1),"\n";function T(&$T){if(($t=array_shift($T))!="(")return$t;for(;$T[0]!=")";$L[]=T($T));array_shift($T);return$L;}function E($X,&$E){if(!is_array($X))return isset($E[$X])?$E[$X]:$X;if("^"==$X[0])return$X;$P=E($X[0],$E);foreach($P[1]as$i=>$f)$E[$f]=E($X[$i+1],$E);return E($P[2],$E);}
```

<div dir=rtl>

## `Javascript`
ئەژماری پیتەکان: ٤٨٥

</div>

```
I=require('readline');r=I.createInterface({input:process.stdin,output:process.stdout});N=[0,{}];L=_=>r.question('',S=>{console.log(E(T(S.replace(/([\(\)])/g,' $1 ').trim().split(/\s+/)),N));L()});T=A=>{if((t=A.shift())!='(')return t;let B=[];while(A[0]!=')')B.push(T(A));A.shift();return B};E=(X,N)=>{if(!Array.isArray(X))return X in N[1]?N[1][X]:N[0]?E(X,N[0]):X;if(X[0]=='^')return[X[1],X[2],N];F=E(X.shift(),N);M=[F[2],{}];for(i in F[0])M[1][F[0][i]]=E(X[i],N);return E(F[1],M)};L()
```
