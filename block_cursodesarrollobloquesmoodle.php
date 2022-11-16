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
 * Curso: desarrollo bloques Moodle
 *
 * @package   block_cursodesarrollobloquesmoodle
 * @copyright 2022 Enrique Ramos Ortiz
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_cursodesarrollobloquesmoodle extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_cursodesarrollobloquesmoodle');
    }

    public function get_content() {

        global $COURSE;

        if ($this->config->disabled) {
            return null;
        }

        if ($this->content !== null) {
            if ($this->config->disabled) {
                return null;
            } else {
            return $this->content;
            }
        }
        
        $this->content =  new stdClass;

        //$this->content->text = 'Hola Mundo desde Moodle!';
        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        } else {
            $this->content->text = 'Puedes cambiar este texto desde la configuración del bloque.';
        }
        
        //Construimos la URL y agregamos al bloque un enlace con la etiqueta AddPage que nos lleve a la vista de una nueva página
        //$this->content->footer = 'Todos los derechos reservados';
        $url = new moodle_url(
            '/blocks/cursodesarrollobloquesmoodle/view.php', 
            array('blockid' => $this->instance->id, 'courseid' => $COURSE->id)
        );
        $this->content->footer = html_writer::link($url, get_string('addpage', 'block_cursodesarrollobloquesmoodle'));

        return $this->content;
    }

    public function specialization() {
        
        if (isset($this->config)) {

            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_cursodesarrollobloquesmoodle');            
            } else {
                $this->title = $this->config->title;
            }
     
            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_cursodesarrollobloquesmoodle');
            }    
        }
     }

     public function instance_allow_multiple() {
        return true;
     }

    //Activamos los settings a nivel administrador (archivo setting.php)
    function has_config() {
        return true;
    }

    //Utilizar el parámetro general definido anteriormente (allowhtml)
    public function instance_config_save($data,$nolongerused =false) {
        global $CFG;
        
        if (!empty($CFG->block_cursodesarrollobloquesmoodle_allowhtml)) {
            // && $CFG->block_cursodesarrollobloquesmoodle_allowhtml == '1'
            $data->text = strip_tags($data->text);
        } 
    
        // Implementación predeterminada definida en la clase principal
        return parent::instance_config_save($data,$nolongerused);
    }

    //Restringir acceso por layout
    function applicable_formats() {
        return array(
            'site-index' => true,
            'course-view' => false,
            'course-view-social' => false,
            'mod' => true,
            'mod-quiz' => false
        );
    }

}