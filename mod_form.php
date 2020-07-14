<?php

defined('MOODLE_INTERNAL') or die;

global $CFG;

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/reg/lib.php');

class mod_reg_mod_form extends moodleform_mod {

    function definition(){
        global $CFG, $DB;

        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('text', 'name', get_string('graduationname', 'reg'), array('size'=> '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $this->standard_intro_elements(get_string('description', 'reg'));
        $mform->addElement('date_selector', 'timecreated', get_string('timecreated', 'reg'));
        $mform->addRule('timecreated', null, 'required', null, 'client');
        $mform->addElement('date_selector', 'timemodified', get_string('timemodified', 'reg'));
        $mform->addRule('timemodified', null, 'required', null, 'client');

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }
}