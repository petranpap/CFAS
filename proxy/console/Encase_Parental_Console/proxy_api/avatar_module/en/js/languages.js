function greekURL() {
	var settings = {
  "url": "https://proxyencase.cut.ac.cy:8090/api/public/update/avatar_lang/gr/https:--www.facebook.com-peter.encase",
  "method": "PUT",
  "timeout": 0,
  
};

$.ajax(settings).done(function (response) {
  
var str = window.location.href;
var res = str.replace("/en/", "/gr/");
window.location.href = res;
});
 } 

function englishURL() {
        var settings = {
  "url": "https://proxyencase.cut.ac.cy:8090/api/public/update/avatar_lang/en/https:--www.facebook.com-peter.encase",
  "method": "PUT",
  "timeout": 0,

};

$.ajax(settings).done(function (response) {
  var str = window.location.href;
var res = str.replace("/gr/", "/en/");
window.location.href = res;
});
 }

