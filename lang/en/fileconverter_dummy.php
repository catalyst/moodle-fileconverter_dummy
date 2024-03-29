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
 * Strings for Dummy document converter.
 *
 * @package   fileconverter_dummy
 * @copyright 2017 Cameron Ball
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Dummy';
$string['requirementsmet'] = 'Requirements met';
$string['requirementsmet_desc'] = 'Used to simulate a situation where the converter is enabled but its requirements are not met. When this setting is off, core will see the Dummy converter as having unmet requirements, and will skip using it. Even if the plugin is enabled.';
