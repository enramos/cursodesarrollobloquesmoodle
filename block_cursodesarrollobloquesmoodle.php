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

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content =  new stdClass;

        //$this->content->text = 'Hola Mundo desde Moodle!';
        if (!empty($this->config->text)) {
            $this->content->text = $this->config->text;
        } else {
            $this->content->text = 'Puedes cambiar este texto desde la configuración del bloque.';
        }
        
        $this->content->footer = 'Todos los derechos reservados';
    
        return $this->content;
    }

    public function specialization() {
        
        if (isset($this->config)) {

            if (empty($this->config->title)) {
                $this->title = get_string('defaulttitle', 'block_holamundo');            
            } else {
                $this->title = $this->config->title;
            }
     
            if (empty($this->config->text)) {
                $this->config->text = get_string('defaulttext', 'block_holamundo');
            }    
        }
     }

}