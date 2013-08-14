function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires*1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) { 
  	options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for(var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];    
    if (propValue !== true) { 
      updatedCookie += "=" + propValue;
     }
  }

  document.cookie = updatedCookie;
}


$(function() {

 $('#loginform').submit(function() {

 $('#loginform .control-group').removeClass("error");

$.post($(this).attr("action"),$(this).serialize(),function(data){
if (data.result == "ok") {
document.location.reload();
} else {
 $('#loginform .control-group').addClass("error");
}
});
return false;

});


$('.close').click(function() {
	$(this).parent().hide();
});

});


