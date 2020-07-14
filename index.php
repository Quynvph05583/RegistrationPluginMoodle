<?php

require_once('../../config.php');
require_once("lib.php");//moi
global $PAGE, $CFG;
$id = required_param('id', PARAM_INT);           // Course ID

//// Ensure that the course specified is valid
//if (!$course = $DB->get_record('course', array('id'=> $id))) {
//    print_error('Course ID is incorrect');
//}
$PAGE->set_url('/mod/reg/index.php', array('id'=>$id));

redirect("$CFG->wwwroot/course/view.php?id=$id");



