(()=>{"use strict";window.addCommas=function(e){for(var t=(e+="").split("."),r=t[0],n=t.length>1?"."+t[1]:"",d=/(\d+)(\d{3})/;d.test(r);)r=r.replace(d,"$1,$2");return r+n},window.getFormattedPrice=function(e){if(""!=e||e>0)return"number"!=typeof e&&(e=e.replace(/,/g,"")),addCommas(e)}})();