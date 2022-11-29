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
 * view.php tiene el control (la lógica) de la página
 *
 * @package   block_cursodesarrollobloquesmoodle
 * @copyright 2022 Enrique Ramos Ortiz
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once('cursodesarrollobloquesmoodle_form.php');

global $DB, $OUTPUT, $PAGE;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);

//0304-29
    // Busca el identificador del bloque
    $blockid = required_param('blockid', PARAM_INT);
    // Busca si hay más variables.
    $id = optional_param('id', 0, PARAM_INT);



//Devuelve un  único registro de la base de datos como un objeto donde se cumplen todas las condiciones dadas
if (!$course = $DB->get_record('course',array('id' => $courseid))) {
    print_error('invalidcourse', 'block_cursodesarrollobloquesmoodle', $courseid);
}

require_login($course);

//VIDEO 27 (0303)
    $PAGE->set_url('/blocks/cursodesarrollobloquesmoodle/view.php', array('id' => $courseid));
    $PAGE->set_pagelayout('standard');
    $PAGE->set_heading(get_string('edithtml', 'block_cursodesarrollobloquesmoodle'));

//0304-29
    // Creamos el nodo del bloque en las migas de pan
    $settingsnode = $PAGE->settingsnav->add(get_string('holamundosettings', 
        'block_holamundo'));
    // Creamos la URL del bloque con el id del bloque
    $editurl = new moodle_url('/blocks/holamundo/view.php', 
        array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
    // Añadimos el nodo con la url del bloque
    $editnode = $settingsnode->add(get_string('editpage', 'block_holamundo'), $editurl);
    // Activamos las migas de pan
    $editnode->make_active();

$cursodesarrollobloquesmoodle = new cursodesarrollobloquesmoodle_form();

echo $OUTPUT->header();
$cursodesarrollobloquesmoodle->display();
echo $OUTPUT->footer();