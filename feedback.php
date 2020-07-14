<?php
require_once('../../config.php');
global $DB,$SESSION ,$CFG;
require_once($CFG->dirroot . '/mod/reg/lib.php');
require_once($CFG->libdir . '/completionlib.php');


$id=$_POST['id'];
$comment=$_POST['comment'];
$status=$_POST['status'];
$sql="UPDATE mdl_reg_detail SET comment ='".$comment."', status = ".$status." WHERE id=".$id;
$DB->execute($sql);
$url = new moodle_url('/mod/reg/view.php', array('id' =>$SESSION->idreg));
return redirect($url);