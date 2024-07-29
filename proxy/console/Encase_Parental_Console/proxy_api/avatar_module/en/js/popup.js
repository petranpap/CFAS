
  function display_fb_url (results){
  fb_url=results;
  fb_url=fb_url.toString();
  fb_url=fb_url.replace(/\//g, "-");
  fb_url = encodeURIComponent(fb_url);
  document.querySelector("#fb_url").innerHTML = "<p style='display:none;'>" + fb_url + "</p>";
  localStorage.setItem("fb_url",fb_url);

}

  function display_fb_name (resultsname){
  fb_name=resultsname;
  document.querySelector("#fb_name").innerHTML = "Hello : " + fb_name + "";
  localStorage.setItem("fb_name",fb_name);

}


 var str1 = "document.querySelectorAll('[title= ";
    var str2 = '"Profile"]';
    var str3 = "')[0].href"
    var res = str1.concat(str2);
    var res = res.concat(str3);

var str1name = "document.querySelectorAll('[title= ";
    var str2name = '"Profile"]';
    var str3name = "')[0].innerText"
    var resname = str1name.concat(str2name);
    var resname = resname.concat(str3name);


chrome.tabs.query({active: true}, function(tabs) {
  var tab = tabs[0];
  chrome.tabs.executeScript(tab.id, {
    code: res
  }, display_fb_url);
});

chrome.tabs.query({active: true}, function(tabs) {
  var tab = tabs[0];
  chrome.tabs.executeScript(tab.id, {
    code: resname
  }, display_fb_name);
});
