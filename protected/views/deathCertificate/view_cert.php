<?php

	$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
								'P', 'cm', 'A4', true, 'UTF-8');

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("Terence Monteiro");
	$pdf->SetTitle("Death Certificate");
	$pdf->SetSubject("Death Certificate");
	$pdf->SetKeywords("PDF");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->AddPage();
	$pdf->SetFont("times", "R", 26);
	$pdf->Cell(0,5,"",0,1);
	$pdf->Cell(3,0,'',0,0);
	$pdf->Cell(0,0,"ROMAN CATHOLIC CEMETERY",0,1,'L');
	$pdf->SetFont("courier", "B", 16);
	$pdf->Cell(5,0,'',0,0);
	$pdf->Cell(0,1,"    PARTICULARS OF BURIAL",0,1,'L');
	$pdf->SetFont("courier", "R", 11);
	$death = $model->death;
	$pdf->Cell(0,1,"",0,1);
	$pdf->Cell(3.5,0,"",0,0);
	$pdf->Cell(0,0,"REF. NO.   " . $death->get_refno(), 0,1,'L');
	$pdf->SetFont("courier", "R", 12);
	$pdf->Cell(0,1.9,"",0,1);

$count = 0;

function yr($dt) {
	return date_format(new DateTime($dt), 'Y');
}

function date_ind($dt) {
	return date_format(new DateTime($dt), 'd/m/Y');
}

function draw_line($pdf) {
	global $count;
	$pdf->Line(10.6,12.2+$count*0.8,16,12.3+$count*0.8,array('width' => 0.01, 'dash' => 3));
	++$count;
}

function show_field($pdf, $label, $value) {
	$pdf->Cell(4,0,"",0,0);
	$pdf->Cell(0,0.8,sprintf("%-20s: %s", strtoupper($label), strtoupper($value)),0,1,'L');
	draw_line($pdf);
}

	show_field($pdf, 'DATE OF DEATH', date_ind($death->death_dt));
	show_field($pdf, 'CAUSE OF DEATH', $death->cause);
	show_field($pdf, 'CHRISTIAN NAME', $death->fname);
	show_field($pdf, 'SUR NAME', $death->lname);
	show_field($pdf, 'AGE', $death->age);
	show_field($pdf, 'PROFESSION', $death->profession);
	show_field($pdf, 'DATE BURIED', $death->buried_dt);
	show_field($pdf, 'minister', $death->minister);
	show_field($pdf, 'PLACE OF BURIED', $death->burial_place);
	$pdf->Cell(0,4,"",0,1);
	$pdf->SetFont("courier", "R", 10);
	$pdf->Cell(0,0,"I CERTIFY THAT THE ABOVE IS TRUE COPY OF AN ENTRY IN THE REGISTER",0,1,'C');
	$pdf->Cell(0,0,"OF BURIALS KEPT AT HOLY REDEEMER CHURCH, BANGALORE",0,1,'C');

	$pdf->Cell(0,3,"",0,1);
	$pdf->Cell(10,1,'DATE: '.date_ind($model->cert_dt),0,0,'C');
	$pdf->Cell(0,1,'PARISH PRIEST          ',0,0,'R');
	#$pdf->AliasNbPages();
	$id = $model->id;
	$pdf->Output("death-cert-$id.pdf", "I");
	Yii::app()->end();

?>