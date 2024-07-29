<?php
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Login
    $app->get('/login/{username}/{password}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM parent inner join childs on childs.parent_id=parent.parent_id WHERE parent.parent_user_name=:username and pass =:password ");
        $sth->bindParam(":username", $args['username']);
        $sth->bindParam(":password", $args['password']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

// Retrieve all parents
    $app->get('/parent', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM parent ");
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });
 
    // Retrieve parent with id 
    $app->get('/parent/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM parent WHERE parent_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

     // Retrieve counter for notifications module
    
    $app->get('/notifications/{parent_id}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT notifications.*,childs.child_first_name from notifications inner join childs on notifications.child_id=childs.child_id inner join parent on parent.parent_id=childs.parent_id where childs.parent_id=:parent_id");
        $sth->bindParam(":parent_id", $args['parent_id']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

    //Retrieve Child With id
    $app->get('/child/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from childs where childs.child_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

 //Retrieve Child's Chat UniqueId With child id
    $app->get('/child_chat_mongo/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT mongouniqueid from fb_msg where fb_msg.child_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

        
 
    // Get Childs Approved Settingss
    $app->get('/parent/child/approved/{id}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from childs inner join parental_visibility on childs.child_id=parental_visibility.child_id inner join backend_visibility on childs.child_id=backend_visibility.child_id inner join security_visibility on childs.child_id=security_visibility.child_id where parental_visibility.child_aproved=1 and backend_visibility.child_aproved=1 and security_visibility.child_aproved=1 and childs.parent_id=:id");
        $sth->bindParam(":id", $args['id']);
        $sth->execute();
//        print_r($sth);
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

    // Get Childs Names for Menu
    $app->get('/menu/child/[{id}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT childs.* from childs inner join parent on parent.parent_id=childs.parent_id where parent.parent_id=:id");
        $sth->bindParam("id", $args['id']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

    //Aprroved Parental Options For Child (Show button in Parental Console )

    $app->get('/parental/options/[{parent_id:[0-9-]+}/[{child_id:[0-9-]+}]]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from parental_visibility where parental_visibility.child_id=:child_id and parental_visibility.child_aproved = 1 and parental_visibility.parent_id=:parent_id");
         
        $sth->bindParam(":parent_id", $args['parent_id']);
        $sth->bindParam(":child_id", $args['child_id']);
        //print_r($sth);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

    //Not-Aprroved Parental Options For Child Browser Add-on

    $app->get('/browser_addon/parental/options/{fb_url}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from childs inner join parental_visibility on childs.child_id=parental_visibility.child_id where childs.child_fb_url=:fb_url ");
         
        $sth->bindParam(":fb_url", $args['fb_url']);
  //      print_r($sth);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

    // Update from Browser add-on ( Child Aprroves Parental Options)
    $app->put('/update/browser_addon/parental/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE parental_visibility inner join childs on childs.child_id=parental_visibility.child_id
            SET parental_visibility.child_aproved=1 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

// Update from Browser add-on ( Child Revokes Parental Options)
    $app->put('/update/browser_addon/parental_revoke/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE parental_visibility inner join childs on childs.child_id=parental_visibility.child_id
            SET parental_visibility.child_aproved=0 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });


    //Aprroved Backend Options For Child (Show button)

     $app->get('/backend/options/[{parent_id:[0-9-]+}/[{child_id:[0-9-]+}]]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from backend_visibility where backend_visibility.child_id=:child_id and backend_visibility.child_aproved = 1 and backend_visibility.parent_id=:parent_id");
         
        $sth->bindParam(":parent_id", $args['parent_id']);
        $sth->bindParam(":child_id", $args['child_id']);
         //print_r($sth);
        $sth->execute();
        // print_r($sth);
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

       //Not-Aprroved Backend Options For Child Browser Add-on

    $app->get('/browser_addon/backend/options/{fb_url}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from childs inner join backend_visibility on childs.child_id=backend_visibility.child_id where childs.child_fb_url=:fb_url ");
         
        $sth->bindParam(":fb_url", $args['fb_url']);
        // print_r($sth);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

     // Update from Browser add-on ( Child Aprroves Backend Options)
    $app->put('/update/browser_addon/backend/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE backend_visibility inner join childs on childs.child_id=backend_visibility.child_id
            SET backend_visibility.child_aproved=1 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

// Update from Browser add-on ( Child Revokes Backend Options)
    $app->put('/update/browser_addon/backend_revoke/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE backend_visibility inner join childs on childs.child_id=backend_visibility.child_id
            SET backend_visibility.child_aproved=0 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });


     //Aprroved Cyber Safety Options For Child (Show button)


     $app->get('/safety/options/[{parent_id:[0-9-]+}/[{child_id:[0-9-]+}]]', function ($request, $response, $args) {

         $sth = $this->db->prepare("SELECT * from security_visibility where security_visibility.child_id=:child_id and security_visibility.child_aproved = 1 and security_visibility.parent_id=:parent_id");
         // 
        $sth->bindParam(":parent_id", $args['parent_id']);
        $sth->bindParam(":child_id", $args['child_id']);
        
        $sth->execute();
        // print_r($sth);
        $todos = $sth->fetchObject();
        // print_r($todos);
        return $this->response->withJson($todos);
    });

        //Not-Aprroved Cyber Safety Options For Child Browser Add-on

    $app->get('/browser_addon/safety/options/{fb_url}', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * from childs inner join security_visibility on childs.child_id=security_visibility.child_id where childs.child_fb_url=:fb_url ");
         
        $sth->bindParam(":fb_url", $args['fb_url']);
        // print_r($sth);
        $sth->execute();
        $todos = $sth->fetchObject();
        return $this->response->withJson($todos);
    });

      // Update from Browser add-on ( Child Aprroves Cyber Safety Options)
    $app->put('/update/browser_addon/safety/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE security_visibility inner join childs on childs.child_id=security_visibility.child_id
            SET security_visibility.child_aproved=1 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

 // Update from Browser add-on ( Child Revokes Cyber Safety Options)
    $app->put('/update/browser_addon/safety_revoke/options/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE security_visibility inner join childs on childs.child_id=security_visibility.child_id
            SET security_visibility.child_aproved=0 where childs.child_fb_url=:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

    //Add notifications
     $app->post('/notifications/{text}/{fb_url}/{href}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO notifications (`text`, `child_id`,`href`) VALUES(:text,(select child_id from childs where child_fb_url=:fb_url OR child_twitter =:fb_url),:href)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":text", $args['text']);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->bindParam(":href", $args['href']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

    //Add notifications_2
     $app->post('/nots', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO notifications (`text`, `child_id`,`href`) VALUES(:text,(select child_id from childs where child_fb_url=:fb_url OR child_twitter =:fb_url),:href)";
	$sth = $this->db->prepare($sql);
        $sth->bindParam(":text", $input['text']);
        $sth->bindParam(":fb_url",$input['fb_url']);
        $sth->bindParam(":href", $input['href']);
        $sth->execute();
        $input['fb_url'] = $input['fb_url'];
        return $this->response->withJson($input);
    });
	//Avatar_lang
      $app->get('/avatar/{fb_url}', function ($request, $response, $args) {
        $sth = $this->db->prepare("select avatar_lang.* from avatar_lang inner join childs on childs.child_id = avatar_lang.child_id where childs.child_fb_url =:fb_url ");
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });


  $app->put('/update/avatar_lang/en/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE avatar_lang inner join childs on childs.child_id = avatar_lang.child_id
            SET `lang`='en' where childs.child_fb_url =:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

  $app->put('/update/avatar_lang/gr/{fb_url}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "UPDATE avatar_lang inner join childs on childs.child_id = avatar_lang.child_id
            SET `lang`='gr' where childs.child_fb_url =:fb_url";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":fb_url", $args['fb_url']);
        $sth->execute();
        $input['fb_url'] = $args['fb_url'];
        return $this->response->withJson($input);
    });

     $app->post('/edu/add', function ($request, $response) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO edu_connect (`childid`, `course`) VALUES(:childid,:course)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":course", $input['course']);
        $sth->bindParam(":childid",$input['childid']);
        $sth->execute();
        return $this->response->withJson('ack');
    });



   $app->get('/edu/get/[{fb_url}]', function ($request, $response, $args) {
        $sth = $this->db->prepare("SELECT * FROM edu_connect INNER JOIN childs ON childs.child_id=edu_connect.childid WHERE childs.child_fb_url=:fb_url group by edu_connect.course");
	$sth->bindParam("fb_url", $args['fb_url']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

   $app->get('/quiz/get/[{fb_url}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM quizzes INNER JOIN user_quiz on user_quiz.quizid = quizzes.id  INNER JOIN childs ON childs.child_id=user_quiz.childid  WHERE childs.child_fb_url=:fb_url AND quizzes.id=11");
        $sth->bindParam("fb_url", $args['fb_url']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

   $app->get('/quiz/get_grade/[{fb_url}]', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM user_quiz_results INNER JOIN childs ON childs.child_id=user_quiz_results.childid  INNER JOIN quizzes on quizzes.id = user_quiz_results.quizid  WHERE childs.child_fb_url=:fb_url GROUP BY user_quiz_results.childid,user_quiz_results.quizid");
        $sth->bindParam("fb_url", $args['fb_url']);
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

   $app->get('/quiz/grades', function ($request, $response, $args) {
         $sth = $this->db->prepare("SELECT * FROM user_quiz_results INNER JOIN childs ON childs.child_id=user_quiz_results.childid INNER JOIN quizzes on quizzes.id = user_quiz_results.quizid");
        $sth->execute();
        $todos = $sth->fetchAll();
        return $this->response->withJson($todos);
    });

   //Add quiz result
     $app->post('/quiz_result_add/{childid}/{quiz_id}/{score}', function ($request, $response, $args) {
        $input = $request->getParsedBody();
        $sql = "INSERT INTO user_quiz_results ( `childid`,`quizid`,`score`) VALUES(:childid,:quiz_id,:score)";
        $sth = $this->db->prepare($sql);
        $sth->bindParam(":childid", $args['childid']);
        $sth->bindParam(":score", $args['score']);
	$sth->bindParam(":quiz_id",$args['quiz_id']);
        $sth->execute();
        return $this->response->withJson('ACK');
    });


// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});
