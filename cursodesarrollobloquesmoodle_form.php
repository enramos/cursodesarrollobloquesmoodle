<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Bloque de saludo al mundo: la vista de los campos
 *
 * @package   block_cursodesarrollobloquesmoodle
 * @copyright 2022 Enrique Ramos Ortiz
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("{$CFG->libdir}/formslib.php");
require_once($CFG->dirroot.'/blocks/cursodesarrollobloquesmoodle/lib.php');


class cursodesarrollobloquesmoodle_form extends moodleform {
    
    function definition() {
        
        $mform = & $this->_form;
        $mform->addElement('header','displayinfo', get_string('textfields', 'block_cursodesarrollobloquesmoodle'));

        //0309-34
            $mform->addElement('hidden', 'blockid');
            $mform->setType('blockid', PARAM_RAW);
            $mform->addElement('hidden', 'courseid');
            $mform->setType('courseid', PARAM_RAW);

        //0305-30
    
            // Elemento de texto
            $mform->addElement('text', 'pagetitle', get_string('pagetitle', 'block_cursodesarrollobloquesmoodle'));
            $mform->setType('pagetitle', PARAM_RAW);
            $mform->addRule('pagetitle', null, 'required', null, 'client');
            
            // Elemento text area con HTML
            $mform->addElement('editor', 'displaytext', get_string('displayedhtml', 'block_cursodesarrollobloquesmoodle'));
            $mform->setType('displaytext', PARAM_RAW);
            $mform->addRule('displaytext', null, 'required', null, 'client');

        //0306-31
        
            // Filepicker
            $mform->addElement(
                'filepicker', 
                'filename', 
                get_string('file'), 
                null, 
                array('accepted_types' => '*')
            );
                    
            // Un grupo de elementos de la imagen
            $mform->addElement(
                'header', 
                'picfield', 
                get_string('picturefields', 'block_cursodesarrollobloquesmoodle'), 
                null, 
                false
            );

            // opci??n si/no
            $mform->addElement(
                'selectyesno', 
                'displaypicture', 
                get_string('displaypicture', 'block_cursodesarrollobloquesmoodle')
            );
            $mform->setDefault('displaypicture', 1);

        //0307-32

            $images = block_cursodesarrollobloquesmoodle_images();
            $radioarray = array();
            for ($i=0; $i < count($images); $i++){
                $radioarray[] =& $mform->createElement('radio', 'picture', '', $images[$i], $i);
            }
            $mform->addGroup($radioarray, 'radioar', get_string('pictureselect', 'block_cursodesarrollobloquesmoodle'), array(' '), FALSE);

        //0308-33
        
            // Selector de fecha
            $mform->addElement(
                'date_time_selector', 
                'displaydate', 
                get_string('displaydate', 'block_cursodesarrollobloquesmoodle'), 
                array('optional' => true)
            );
            $mform->setAdvanced('optional');

        //0309-34

            //A??adimos los botones de opci??n
            $this->add_action_buttons();
    }
}