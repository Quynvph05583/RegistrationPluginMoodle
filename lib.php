<?php
defined('MOODLE_INTERNAL') || die;


function reg_add_instance($post){
    global $DB, $CFG;
//    $course = $DB->get_record('course', array('id' => $post->course), '*', MUST_EXIST);
    $event = new stdClass();
    $event->name = $post->name;
    $event->intro = $post->intro;
    $event->course = $post->course;
    $event->timecreated = $post->timecreated;
    $event->timemodified = $post->timemodified;
    //add_event($event);
    return $DB->insert_record('reg', $event);
}
function reg_update_instance($reg)
{
    global $DB;
    $reg->timemodified = time();
    $reg->id = $reg->instance;

    $DB->update_record('reg', $reg);

    $book = $DB->get_record('reg', array('id'=>$reg->id));

    return true;
}

function reg_delete_instance($id){
    global $DB;

    if (!$reg = $DB->get_record("reg", array('id' => $id))) {
        return false;
    }

    $result = true;

    if (!$DB->delete_records("reg_detail", array('id' => $reg->id))) {
        $result = false;
    }

    if (!$DB->delete_records("reg", array('id' => $reg->id))) {
        $result = false;
    }
    return $result;
}
