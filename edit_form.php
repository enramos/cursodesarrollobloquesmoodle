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

class block_cursodesarrollobloquesmoodle_edit_form extends block_edit_form {
        
    protected function specific_definition($mform) {
        
        // Añade la sección de configuración de parámetros.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block'));

        // Agrega un campo de configuración de texto
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_cursodesarrollobloquesmoodle'));
        $mform->setDefault('config_text', 'Cadena por omisión');
        $mform->setType('config_text', PARAM_RAW);        

    }
}