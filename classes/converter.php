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

namespace fileconverter_dummy;

defined('MOODLE_INTERNAL') || die();

use core_files\conversion;
use core_files\converter_interface;

/**
 * Dummy document converter class.
 *
 * @package   fileconverter_dummy
 * @copyright 2017 Cameron Ball
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class converter implements converter_interface {

    /**
     * Emulate document conversion in progress and cook a dummy PDF file.
     *
     * @param   conversion $conversion Conversion object
     * @return  $this
     */
    public function start_document_conversion(conversion $conversion) :self {
        global $CFG;

        require_once($CFG->libdir . '/pdflib.php');
        $tmpdir = make_request_directory();
        $tmppdf = $tmpdir . '/' . 'dummy.pdf';

        $pdf = new \pdf;
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        $sourcefile = $conversion->get_sourcefile();
        $mimetype = $sourcefile->get_mimetype();
        switch ($mimetype) {
            case 'text/plain':
            case 'text/html':
            case 'text/csv':
                $pdf->Write(5, $sourcefile->get_content());
                break;

            case 'image/bmp':
            case 'image/gif':
            case 'image/jpeg':
            case 'image/png':
            case 'image/tiff':
            case 'image/webp':
                $pdf->Image('@' . $sourcefile->get_content());
                break;

            default:
                $pdf->Write(5, 'Mock content for converted PDF file');
                break;
        }

        $pdf->Output($tmppdf, 'F');

        $conversion->store_destfile_from_path($tmppdf)
                   ->set('status', conversion::STATUS_IN_PROGRESS)
                   ->set('statusmessage', 'Oh henlo')
                   ->update();

        mtrace('Dummy conversion started.');

        return $this;
    }

    /**
     * Poll an existing conversion for status update.
     *
     * @param   conversion $conversion The file to be converted
     * @return  $this
     */
    public function poll_conversion_status(conversion $conversion) :self {
        $conversion->set('status', conversion::STATUS_COMPLETE);
        mtrace('Dummy conversion completed.');

        return $this;
    }

    /**
     * Whether the plugin is configured and requirements are met.
     *
     * @return  bool
     */
    public static function are_requirements_met() :bool {
        return true;
    }

    /**
     * Whether a file conversion can be completed using this converter.
     *
     * @param   string $from The source type
     * @param   string $to The destination type
     * @return  bool
     */
    public static function supports($from, $to) :bool {
        return true;
    }

    /**
     * A list of the supported conversions.
     *
     * @return  string
     */
    public function get_supported_conversions() :string {
        return 'THE ALL OF THEM';
    }
}
