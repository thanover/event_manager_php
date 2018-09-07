<?php
    //include the database file with functions for obtaining the courses and students from the database
    require('model/database.php');
    require('model/events_db.php');
    require('model/users_db.php');
    require('model/invites_db.php');

    // extract the format and action
    $format = $_GET['format'];
    $action = $_GET['action'];
    
    //check for the various combination of format and actions and call corresponding function
    if($format == 'xml' && $action == 'events'){
        send_xml_events();
    } else if ($format == 'xml' && $action == 'users'){
        send_xml_users();
    } else if ($format == 'xml' && $action == 'invites'){
        //checks if a course was provided
        if(!isset($_GET['event'])){
            echo 'please provide a eventID. Format should be"/rest.php?format=xml&action=invites&<b><u>&event=id</b></u>"';
        } else {
            $event = $_GET['event'];
            send_xml_invites($event);
        }
    } else if ($format == 'json' && $action == 'events') {
        send_json_events();
    } else if ($format == 'json' && $action == 'users') {
        send_json_students();
    } else if ($format == 'json' && $action == 'invites'){
        //checks if a course was provided
        if(!isset($_GET['event'])){
            echo 'please provide a eventID. Format should be"/rest.php?format=json&action=invites&<b><u>&event=id</b></u>"';
        } else {
            $event = $_GET['event'];
            send_json_invites($event);
        }
    } else {
        // send an error to the user if the url provided isn't a valid API call
        echo "sorry, incorrect format for API call, please use either: <br> 
        (1) /rest.php?format=xml&action=users <br>
        (2) /rest.php?format=json&action=users <br>
        (3) /rest.php?format=xml&action=events <br>
        (4) /rest.php?format=json&action=events <br>
        (5) /rest.php?format=xml&action=invites&event=:ID <br>
        (6) /rest.php?format=json&action=invites&event=:ID";
    }
    
    function send_xml_events(){
        $events = get_all_events();
        $file = 'events.xml';

        // initialize the DOMDocument
        $doc = new DOMDocument('1.0');

        //set the name of the root element
        $root = $doc->createElement('events');

        foreach ($events as $event){
            $eventElm = $doc->createElement('event');
            foreach($event as $key=>$value){
                $i = $doc->createElement($key, $value);
                $eventElm->appendChild($i);
            }
            
            $root->appendChild($eventElm);
        }
        
        $doc->appendChild($root);
        
        $doc->save("./xml/".$file) or die('something went wrong');
        
        header('Content-Type: text/xml');

        //display the xml file
        include('./xml/events.xml');
    }

    function send_json_events(){
        $events = get_all_events();
        echo json_encode($events);
    }

    function send_xml_invites($event){
        //get students from the DB
        $invites = get_invites_by_eventID($event);
        
        //send an error to the user if the course that they provided isn't a valid courseID, or if the course doesn't have any users
        if(count($invites)==0){
            $events = get_all_events();
            $event_exists = false;  
            
            foreach($events as $a_event){
                if($a_event['eventID']==$event){
                    echo 'course "'.$event.'" does not have any invites in it';
                    $event_exists = true;
                }
            }
            if($event_exists == false){
                echo 'An eventID was not provided.  Check "rest.php?format=xml&action=courses" if the course exists or not';
            }
        }  else {
            
            // follow the same procedure as the above function
            $file = 'invites.xml';
            $doc = new DOMDocument('1.0');
            $root = $doc->createElement('invites');

            foreach ($invites as $invite){
                $inviteElm = $doc->createElement('invite');
                foreach($invite as $key=>$value){
                    $i = $doc->createElement($key, $value);
                    $inviteElm->appendChild($i);
                }
                $root->appendChild($inviteElm);
            }
            $doc->appendChild($root);
            $doc->save("./xml/".$file) or die('something went wrong');
            header('Content-Type: text/xml');
            include('./xml/invites.xml');
        }

    }   

    function send_json_invites($event){
        $invites = get_invites_by_eventID($event);
        
        //send an error to the user if the course that they provided isn't a valid courseID, or if the course doesn't have any users
        if(count($invites)==0){
            $events = get_all_events();
            $event_exists = false;
            foreach($events as $a_event){
                if($a_event['eventID']==$event){
                    echo 'event "'.$event.'" does not have anyone invited to it';
                    $event_exists = true;
                }
            }
            if($event_exists == false){
                echo 'An eventID was not provided. Check "/rest.php?format=json&action=events" if the event exists or not';
            }
        } else {
            //encode result as a JSON file and display it
            echo json_encode($invites);
        }
    }

    function send_xml_users() {
        // get all the courses from the DB
        $users = get_all_users();
        
        //set the name of the file
        $file = 'users.xml';

        // initialize the DOMDocument
        $doc = new DOMDocument('1.0');

        //set the name of the root element
        $root = $doc->createElement('users');

        //iterate through the courses returned from the DQ query
        foreach ($users as $user){
            $userElm = $doc->createElement('user');

            //iterate through the values provided for each course
            foreach($user as $key=>$value){
                $i = $doc->createElement($key, $value);
                $userElm->appendChild($i);
            }
            
            //add the course element to root element
            $root->appendChild($userElm);
        }
        //append the $root to the DOMDocument
        $doc->appendChild($root);

        //save the DOM document as an xml
        $doc->save("./xml/".$file) or die('something went wrong');
        
        //tell the browser the document type is xml
        header('Content-Type: text/xml');

        //display the xml file
        include('./xml/users.xml');
    }

    function send_json_students(){        
        $users = get_all_users();
        echo json_encode($users);
    }

    // http://localhost:8888/project_V2/rest.php?format=xml&action=events
    // http://localhost:8888/project_V2/rest.php?format=xml&action=users
    // http://localhost:8888/project_V2/rest.php?format=xml&action=invites&event=1
    // http://localhost:8888/project_V2/rest.php?format=json&action=events
    // http://localhost:8888/project_V2/rest.php?format=json&action=users
    // http://localhost:8888/project_V2/rest.php?format=json&action=invites&event=1

?>