function greek() {
	var request = require('request');
	var options = {
	  'method': 'PUT',
	  'url': 'https://proxyencase.cut.ac.cy:8090/api/public/update/avatar_lang/gr/https:--www.facebook.com-peter.encase?fbclid=IwAR11q9pfRKDQGAs0mMtf9ehmcM3zCzNTHWdOmFSEBRJUFNYxiLj0QZsEx7I',
	  'headers': {
	    'Cookie': 'PHPSESSID=cdvrj62f41ltnf34ha2672ec45'
	  }
	};
	request(options, function (error, response) {
	  if (error) throw new Error(error);
	  console.log(response.body);
	});
}
