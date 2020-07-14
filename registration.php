<?php

require_once('reg_form.php');
global $DB, $OUTPUT, $USER;

$mform = new mod_reg_form();

if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    return 1;
} elseif ($reg = $mform->get_data()) {
    $reg->timecreated = time();
    $reg->iduser = $USER->id;
    $id = $DB->insert_record('reg_detail', $reg);
    $url = new moodle_url('/mod/reg/view.php', array('id' => $reg->idreg));
    return redirect($url);
} else {
    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();
}
