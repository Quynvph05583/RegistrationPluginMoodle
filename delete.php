<?php
require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);
global $DB, $SESSION;
$reg = $DB->delete_records("reg_detail", array('id' =>$id));
$url = new moodle_url('/mod/reg/view.php', array('id'=>$SESSION->idreg));
return redirect($url);




