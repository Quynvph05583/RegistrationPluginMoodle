<?php
require_once('../../config.php');
require_once('lib.php');


$id_detail = optional_param('id', 0, PARAM_INT);
global $DB, $CFG, $OUTPUT, $PAGE, $SESSION;
$records = $DB->get_record_sql('SELECT *,mdl_reg_detail.id as idregdetail,mdl_reg_detail.description as descriptionreg FROM mdl_reg_detail,mdl_user WHERE mdl_user.id=mdl_reg_detail.iduser and mdl_reg_detail.id =' . $id_detail);

$context = context_module::instance($records->id);
$teacher =has_capability('mod/reg:manage', $context);
$student = has_capability('mod/reg:view', $context);

echo $OUTPUT->header();

if($teacher) {
    echo '<form class="kt-form kt-form--label-right">';
    echo '<div class="kt-portlet__body">';
    echo '<div class="kt-section kt-section--first">';
    echo '<div class="kt-section__body">';
    echo '<div class="row"><label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6"><h3 class="kt-section__title kt-section__title-sm">' . get_string("info", "reg") . '</h3></div></div>';
    echo '<br><br>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("name", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->username . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("topic", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->topic . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("description", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><textarea style="background-color: #e9ecef; padding-left: 12px" rows="2" cols="103" readonly="readonly" placeholder="'. $records->descriptionreg .'"></textarea>
                    </div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("tutor", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->tutor . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("company", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->company . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("timestart", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' .date("d-m-Y",($records->timestart)) . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("timeend", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . date("d-m-Y",($records->timeend)) . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
    echo '<br>';
    echo "<form action=\"$CFG->wwwroot/mod/reg/feedback.php\" method=\"post\">";
    echo '<input name="id" hidden value="'.$id_detail.'">';
    echo '<div class="row"><label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6"><h3 class="kt-section__title kt-section__title-sm">' . get_string("feedback", "reg") . '</h3></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("comment", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><textarea rows="4" cols="50" name="comment" value="' . $records->comment . '" class="form-control"></textarea></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("Status", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6">
  <select class="form-control col-lg-9 col-xl-3" name="status" style="border-radius: 5px; font-weight: bold"  >
    <option value="0" style="color: orange; font-weight: bold">' . get_string("wait", "reg") . '</option>
    <option value="1" style="color: #008800; font-weight: bold">' . get_string("pass", "reg") . '</option>
    <option value="2" style="color: red; font-weight: bold">' . get_string("not_yet", "reg") . '</option>
</select></div></div>';
    echo '<input style="width: 100%;
  background-color: #1177d1;
  color: white;
  border: none;
  padding: 14px 20px;
  margin: 8px 0;
  border-radius: 4px;" 
  type="submit" value="' . get_string("save", "reg") . '"></div>';
    echo '</form>';
} else {

    echo "<form action=\"$CFG->wwwroot/mod/reg/view.php?id=\" method=\"post\">";

    echo '<div class="kt-portlet__body">';
    echo '<div class="kt-section kt-section--first">';
    echo '<div class="kt-section__body">';

    echo '<div class="row"><label class="col-xl-3"></label>
                    <div class="col-lg-9 col-xl-6"><h3 class="kt-section__title kt-section__title-sm">' . get_string("info", "reg") . '</h3></div></div>';
    echo '<br><br>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("name", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->username . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("topic", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->topic . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("description", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><textarea style="background-color: #e9ecef; color: black; padding-left: 12px; border:#0088cc" rows="2" cols="103" readonly="readonly" placeholder="'. $records->descriptionreg .'"></textarea>
                    </div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("tutor", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->tutor . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("company", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' . $records->company . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("timestart", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' .date("d-m-Y",($records->timestart)) . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("timeend", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><input type="text" value="' .date("d-m-Y",($records->timeend)) . '" readonly="readonly"
                                                          class="form-control"></div></div>';
    echo '<div class="form-group row"><label class="col-xl-3 col-lg-3 col-form-label">' . get_string("comment", "reg") . '</label>
                    <div class="col-lg-9 col-xl-6"><textarea style="background-color: #e9ecef; color: black; padding-left: 12px; border:#0088cc" rows="6" cols="103" readonly="readonly" placeholder="'. $records->comment .'"></textarea>
               </div></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    $url = new moodle_url('/mod/reg/view.php', array('id'=>$SESSION->idreg));
    echo '<a 
    class="form-control btn btn-primary"
  style="width: 100%;
  background-color: #1177d1;
  color: white;
  border: none;
  padding: 14px 20px;
  margin: 8px 0;
  text-align: center;
  border-radius: 4px;" href="'.$url.'">OK</a></div>';
    echo '</form>';
}
echo $OUTPUT->footer();