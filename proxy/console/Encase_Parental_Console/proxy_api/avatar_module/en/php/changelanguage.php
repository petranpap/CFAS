<?php
    function func()
    {
        $request = new HTTP_Request2();
        $request->setUrl('https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/gr/options/index.php?fb_url=https:--www.facebook.com-peter.encase#languages');
        $request->setMethod(HTTP_Request2::METHOD_PUT);
        $request->setConfig(array(
          'follow_redirects' => TRUE
        ));
	try {
          $response = $request->send();
          if ($response->getStatus() == 200) {
            echo $response->getBody();
          }
          else {
            echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
            $response->getReasonPhrase();
          }
	}
	catch(HTTP_Request2_Exception $e) {
          echo 'Error: ' . $e->getMessage();
        }     
    }
?>
