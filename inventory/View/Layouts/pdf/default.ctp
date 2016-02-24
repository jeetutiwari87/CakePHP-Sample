<?php
require_once(APP . 'Vendor' . DS . 'dompdf' . DS . 'dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');
$dompdf = new DOMPDF();
$dompdf->set_paper = 'A4';
$dompdf->load_html(utf8_decode($content_for_layout), Configure::read('App.encoding'));
$dompdf->render();
$content=$dompdf->output();
$current_date=date('Ymd');
if(file_put_contents(WWW_ROOT.'uploads/reports/survey_report_'.$current_date.'_'.$id.'.pdf',$content)) {
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename="survey_report_'.$current_date.'_'.$id.'.pdf"');
	readfile(WWW_ROOT.'uploads/reports/survey_report_'.$current_date.'_'.$id.'.pdf');
}
//echo $content;