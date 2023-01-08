<?php
// Imports
include_once dirname(__DIR__).'/backend/controller.php';
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';

// Initializations
$links =  new Links();
$controller = new Controller();
$pp = new page_processor();

$search_mode = null;
$search_query = null;
$search_page = null;

$search_data = null;
$search_result = null;
$search_length = null;

// Program
$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, proceed to the rest of the task, if not show a 404 error
if($pp->logged_in){
//     If logged in, check if GET details are avaialable
    if(!empty($_GET['mode']) && ($_GET['mode']==='1' || $_GET['mode']==='2')){
        // If GET details are available, check if the mode is valid
        $search_mode = $_GET['mode'];
        if(!empty($_GET['query'])){ // Search query is available,search for relevant items
            $search_query = $_GET['query'];
        }

        if(!empty($_GET['page'])){ // Search page is available, search for relevant items
            $search_page = (int)$_GET['page'];
        } else { // Search page is not available, set to 1
            $search_page = 1;
        }
        // If mode is 1, search by project
        if($search_mode==='1'){
            // Search for relevant items
            $search_data = $controller->get_projects_by_search($search_query, $search_page);

        }else{  // If mode is 2, search by user
            // Search for relevant items
            $search_data = $controller->get_users_by_search($search_query, $search_page);
        }
        echo json_encode($search_data);
    } else { // If empty mode, send 404
        http_response_code(404); // Send 404 error
        die();
    }
} else {
  // If not logged in, show a 403 error
    http_response_code(403); // Forbidden
    die();
}

?>
