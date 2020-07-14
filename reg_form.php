<?php
require_once('../../config.php');
require_login();
defined('MOODLE_INTERNAL') or die;
global $CFG;
require_once($CFG->dirroot . '/lib/formslib.php');

class mod_reg_form extends moodleform
{
    public function definition()
    {
        global $CFG, $DB, $OUTPUT;
        $idreg = isset($_POST['cmid'])?$_POST['cmid']:0;
        $mform =& $this->_form;

        //-------------------------------------------------------------------------------
        /// Adding the "general" fieldset, where all the common settings are showed
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('hidden', 'idreg', get_string('idreg', 'reg'), array('size' => '64'));
        $mform->setDefault('idreg', $idreg);
        $mform->addElement('text', 'topic', get_string('topic', 'reg'), array('size' => '64'));
        $mform->addRule('topic', null, 'required', null, 'client');
        $mform->addElement('textarea','description', get_string('description', 'reg'), 'wrap="virtual" rows="15" cols="67"');
        $mform->addRule('description', null, 'required', null, 'client');
        $mform->addElement('text', 'tutor', get_string('tutor', 'reg'), array('size' => '64'));
        $mform->addRule('tutor', null, 'required', null, 'client');
        $mform->addElement('text', 'company', get_string('company', 'reg'), array('size' => '64'));
        $mform->addRule('company', null, 'required', null, 'client');
        $mform->addElement('date_selector', 'timestart', get_string('timestart', 'reg'));
        $mform->addRule('timestart', null, 'required', null, 'client');
        $mform->addElement('date_selector', 'timeend', get_string('timeend', 'reg'));
        $mform->addRule('timeend', null, 'required', null, 'client');
        $this->add_action_buttons();
    }
}

