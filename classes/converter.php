<?php declare(strict_types=1);
namespace fileconverter_dummy;

defined('MOODLE_INTERNAL') || die();

use core_files\conversion;
use core_files\converter_interface;

class converter implements converter_interface {

    public function start_document_conversion(conversion $conversion) : self {
        global $CFG;

        require_once($CFG->libdir . '/pdflib.php');
        $tmpdir = make_request_directory();
        $tmppdf = $tmpdir . '/' . 'dummy.pdf';

        $pdf = new \pdf;
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->Write(5, $conversion->get_sourcefile()->get_content());
        $pdf->Output($tmppdf, 'F');

        $conversion->store_destfile_from_path($tmppdf)
                   ->set('status', conversion::STATUS_IN_PROGRESS)
                   ->set('statusmessage', 'Oh henlo')
                   ->update();

        mtrace("Hello from start_document_conversion");

        return $this;
    }

    public function poll_conversion_status(conversion $conversion) : self {
        //if (rand(1,5) == 5) {
            $conversion->set('status', conversion::STATUS_COMPLETE);
            mtrace("Hello from poll_conversion_status. The conversion is complete!");
        //} else {
        //    mtrace("Hello from poll_onversion_status. The conversion is still ongoing.");
        //}

        return $this;
    }

    public static function are_requirements_met() : bool {
        return true;
    }

    public static function supports($from, $to) : bool {
        return true;
    }

    public function get_supported_conversions() : string {
        return 'THE ALL OF THEM';
    }
}
