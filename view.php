<?php
require_once('../../config.php');
require_once('lib.php');


$id = optional_param('id', 0, PARAM_INT);
global $DB, $CFG, $OUTPUT, $PAGE, $USER;

if (!$cm = get_coursemodule_from_id('reg', $id)) {
    print_error('Error');
}
$reg = $DB->get_record('reg', array('id'=>$cm->instance), '*', MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/reg:view', $context);
echo $OUTPUT->header();
global $SESSION;
$SESSION->idreg=$cm->id;
$teacher =has_capability('mod/reg:manage', $context);
$student = has_capability('mod/reg:view', $context);

if ($teacher) {
    echo '<h3>Danh sách đăng kí</h3>';
    $regs = $DB->get_records_sql('select *,mdl_reg_detail.id as idregdetail from mdl_user, mdl_reg_detail where mdl_reg_detail.iduser = mdl_user.id and mdl_reg_detail.idreg ='.$cm->id);
    $table = new html_table();
    $table->head = array(get_string("id", "reg"), get_string("name", "reg"), get_string("topic", "reg"), get_string("status", "reg"), get_string("select", "reg"));
    foreach ($regs as $records) {
        $table->data[] = array(
            $records->id,
            $records->username,
            $records->topic,
            $records->status==0?'<span style="color: orange">'.get_string("wait", "reg").'</span>': ($records->status==1? '<span style="color: #008800">'.get_string("passed", "reg").'</span>' : '<span style="color: red">'.get_string("not_yet", "reg").'</span>'),
            '<a class="btn btn-primary" href='.new moodle_url('/mod/reg/reg_detail.php', array('id' => $records->idregdetail)).'>View</a>
             <a class="btn btn-danger" href='.new moodle_url('/mod/reg/delete.php', array('id' => $records->idregdetail)).'>Xóa</a>',
            );

    }
    echo html_writer::table($table);
} else {
    echo "<form method='post' \" action=\"$CFG->wwwroot/mod/reg/registration.php\">";
    echo "<input style='background-color: #0088cc' type=\"hidden\" name=\"cmid\" value=\"$cm->id\" />";
    echo '<input style="border: 1px solid ; padding: 10px; border-radius: 25px; border: none" type="submit" class="btn btn-info" value="' . get_string('registration', 'reg') . '"/>';
    echo '</form>';
    echo "</div>\n";
    $sql='SELECT *,mdl_reg_detail.id as idregdetail FROM mdl_user,mdl_reg_detail where mdl_reg_detail.iduser= mdl_user.id and mdl_reg_detail.iduser='.$USER->id.' and mdl_reg_detail.idreg ='.$cm->id;
    $regs = $DB->get_records_sql($sql);
    $regs->userid;
    $table = new html_table();
    foreach ($regs as $records) {
        $table->head = array(get_string("id", "reg"),get_string("topic", "reg"),get_string("tutor", "reg"),get_string("status", "reg"),get_string("select", "reg"));
        $table->data[]= array(
            $records->id,
            $records->topic,
            $records->tutor,
            $records->status==0?'<span style="color: orange">'.get_string("wait", "reg").'</span>': ($records->status==1? '<span style="color: #008800">'.get_string("passed", "reg").'</span>' : '<span style="color: red">'.get_string("not_yet", "reg").'</span>'),
        '<a class="btn btn-primary" href='.new moodle_url('/mod/reg/reg_detail.php', array('id' => $records->idregdetail)).'>View</a>');
     }
//        echo 'Bạn chưa đăng kí đề tài';
//    -------------------------------------

    echo html_writer::table($table);
}
echo $OUTPUT->footer();