<?php

namespace app\controllers;
use Yii;
# use app\models\Fieldtrip;
# use app\models\FieldtripSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use TCPDF;

class LabelController extends Controller
{
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all Fieldtrip models.
     * @return mixed
     */
    public function actionIndex($id = null, $fasel = null)
    {
/*
	$d = $_VARS['d'];

    $label = getLabelTemplateDocumentByID($d['ltid']);

//	da($label);
#	da($d);
//	exit;

	# optionen:
	$skip_empty_lines  = true;
	$skip_empty_vlines = true;
	$text_align        = "left"; // right
	$text_wrap         = "cut";  // "wrap"; // "cut" - +berlangen Text abschneiden; // "wrap" - überlangen Text versuchen in die nächste Zeile zu bringen


	$label_width   = $label['lw'];
	$label_height  = $label['lh'];
	$label_spacing = $label['ls'];
	$border        = $label['b'];
	$border_width  = $label['bw'];
	$margin_width  = $label['mw'];
	$font          = $label['f'];
	$font_size     = $label['fs'];

	# lc
    $text_valign = $label['tva']; // vertical text align (bezieht sich auf den normalen Text: oben, mitte unten)

	# vlc
	$vertical_lines          = $d['v'];
    $vertical_text_bound     = $label['vtb'];
    $vertical_text_direction = $label['vtd'];


 	$cropmark         = $label['c'];
	$cropmark_width   = 0.005;
	$cropmark_length  = 10;
	$cropmark_spacing = 0.0;
	$cropmark_style   = $label['cs']; // inner / outer / all
	$cropmark_width   = 0.005;        // Randmarken verlaufen auf den Aussenkanten der (gedachten) Rahmen
	$cropmark_line    = $label['cl']; // durchgezogen / gestrichelt / punktiert

	switch ($cropmark_line) {
		case 'dotted':
			$dash_pattern = array(0.1,0.2); 	// fein gepunktet Linie für inner/all Schnittmarken (cropmark)
			break;

		case 'dashed':
			$dash_pattern = array(0.1,1); 	    // fein gestrichelte Linie für inner/all Schnittmarken (cropmark)
			break;

		case 'solid':
		default:
			$dash_pattern = array(); 			// durchgezogene Linie für inner/all Schnittmarken (cropmark)
			break;
	}


	$randmarke = ($cropmark_width > 0);

    // Markierung f�r Nadeleinstich:
	$pinmark          = $label['p'];
	$pinmark_left     = $label['pl'];
	$pinmark_aligne   = $label['pa']; // center, custom
	$pinmark_width    = 0.1;
	$pinmark_diameter = 0.3;

	$pegmark          = $label['pe'];
	$pegmark_style    = $label['pes'];
	$pegmark_margin   = $label['pem'];
	$pinmark_width    = 0.1;
	$pegmark_diameter = 0.3;

	$line  = $d['l'];
	$vline = $d['vl'];

	$page_count  = $d['pc'];  // Wie viele Seiten sollen erstellt ertsellt werden
	$paper_size  = $d['ps'];  // Papiergröße?
	$orientation = $d['po'];  // portrait oder landscape?


	// Evtl. noch in die Benutzereinstellungen
	// effektive Ränder:
	$left_margin   = 30;
	$top_margin    = 10;
	$right_margin  = 10;
	$bottom_margin = 10;

	// Werte für HP LaserJet 6L
	// muss für jeden Drucker angepasst werden... (evtl. auch in die Benutzer-Einstellungen)
	$printable_left_margin   = 6.5;
	$printable_right_margin  = 6.5;
	$printable_top_margin    = 7.25;
	$printable_bottom_margin = 4.2;



	// Zeilenh�he ermitteln:
	$line_height = $font_size * 25.5 / 72;





*/














        $orientation = 'P';
        $unit        = 'mm';
        $format      = 'A6';
        $unicode     = true;
        $encoding    = 'UTF-8';
        $diskcache   = false;
        $pdfa        = false;



        $pdf = new TCPDF($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);

        // disable header and footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//        $pdf->setFooterData(array(0,64,0), array(0,64,128));
//
//        // set header and footer fonts
//        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//        // set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//            require_once(dirname(__FILE__).'/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }

        // ---------------------------------------------------------

        // set default font subsetting mode
//        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 4, '', true);
//        $pdf->SetFont('CorpoSBold', '', 4, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();


        $lineStyle1 = [
            'width' => 0.5,
            'cap'   => 'butt',
            'join'  => 'miter',
            'dash'  => '10,20,5,10',
            'phase' => 10,
            'color' => [0, 0, 0]
        ];

        $lineStyle2 = [
            'width' => 0.1,
            'cap'   => 'butt',
            'join'  => 'miter',
            'dash'  => 0,
            'color' => [0, 0, 0]
        ];

        $lineStyle3 = [
            'width' => 1,
            'cap' => 'round',
            'join' => 'round',
            'dash' => '2,10',
            'color' => [0, 0, 0]
        ];


        $xPosition = 15.0;
        $yPosition = 15.0;
        $lb = 16.0;
        $lh = 6.0;

//        $pdf->Line(5, 10, 80, 30, $lineStyle1);

        # -------
        #
        #
//        $pdf->Line($xPosition, $yPosition, $xPosition + $lb, $yPosition, $lineStyle2);
//        $pdf->Line($xPosition, $yPosition, $xPosition + $lb, $yPosition, $lineStyle2);

//        $pdf->Rect(100, 10, 40, 20, 'DF', $lineStyle2, [220, 220, 200]);

//        $pdf->Line(5, 10, 80, 10, $lineStyle3);

        // Print text using writeHTMLCell()
//        $pdf->SetX($xPosition);
//        $pdf->SetY($yPosition);

        $text = 'Germany, Bavaria <br/>Würzburg Thüngersheim 10.IV.2011';

        $pdf->SetFont('helvetica', 'B', 3.8, '', true);
        $pdf->setCellHeightRatio(0.998);

//        $arr = $pdf->GetStringWidth($text, 'helvetica', "B", 4, false);
//        error_log(print_r($arr, true));


//        , SetDrawColor(), SetFillColor(), SetTextColor(), SetLineWidth(), Cell(), Write(), SetAutoPageBreak()

        $pdf->setCellPaddings(0, 0, 0, 0);

        $x = $xPosition;
        $y = $yPosition;

        $pdf->MultiCell($lb, $lh, $text, $border = 1, $align = 'L', $fill = false, $ln = 0, $x, $y, $reseth = false, $stretch = false, $isHtml = true);



        $pdf->StartTransform();

            $x = $xPosition + 16.0 - 3.0;
            $y = $yPosition +  6.0;

            $pdf->SetX($xPosition + 0);
            $pdf->SetY($yPosition + 0);
            $pdf->setCellHeightRatio(0.99);
            //        leg. J. Brunner

            $pdf->Rotate(90, $x, $y);
            $pdf->MultiCell(6, 3, "leg. Joh. Brunner", $border = 0, $align = 'J', $fill = false, $ln = 0, $x, $y, $reseth = true, false, false);


        $pdf->StopTransform();


        // Schnittmarken
        $x = $xPosition + 13.5;
        $y = $lh / 2;





//        $pdf->MultiCell(16, 6, $text, $border = 0, $align = 'J', $fill = true, $ln = 0, $x = "", $y = "", $reseth = false, $stretch = false, $isHtml = false);
        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('example_001.pdf', 'I');






        echo "Index-Action!";

     #   return $this->render('index');
    }
//        $searchModel = new FieldtripSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
}