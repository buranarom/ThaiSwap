# ThaiSwap
Normalize character order and remove excessive characters. ported from th_normalize in [Libthai project](https://linux.thai.net/projects/libthai) to Coffeescirpt. It's help to solve user input with incorrect character order such as `มั้ง (ม + -ั + -้ + ง)` and `ม้ัง (ม + -้ + -ั + ง)` is same in Thai language but isn't look same in computer. 

## Installation
ThaiSwap is available in NPM by using command
```
npm install thaiswap
```
or download minified javascript from [Github](https://github.com/pureexe/ThaiSwap/releases)

## Usage
ThaiSwap is compatible with Browser and CommonJS

### Browser
``` html
<script src="path-to-thaiswap-file"></script>
<script>
  var a = "มั้ง";
  var b = "ม้ัง";
  a = ThaiSwap(a);
  b = ThaiSwap(b);
  if(a == b){
    console.log("มั้ง and ม้ัง is same after Normalize order");
  }
</script>
```

### CommonJS
``` javascript
var ThaiSwap = require("thaiswap");
var a = "มั้ง";
var b = "ม้ัง";
a = ThaiSwap(a);
b = ThaiSwap(b);
if(a == b){
  console.log("มั้ง and ม้ัง is same after Normalize order");
}
```

## Ported by
Pakkapon Phongthawee (phongthawee_p@silpakorn.edu)
