<?php
$this->load->library('fpdf');
class PDF extends FPDF
{
	//Page header
	function Header()
	{
		
	}
 
	//Page Content
	function Content($header, $rolls, $customer)
	{   
        $minimal = 10;
		$this->SetFont('Times','',12);
		// Column widths
        $w = array(10, 80, 50, 50);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'C');
        $this->Ln();
        // Data
        $no = 1;
        foreach($rolls as $roll)
        {
            $this->Cell($w[0],7,$no++,1,0);
            $this->Cell($w[1],7,$customer,1,0,'L');
            $this->Cell($w[2],7,$roll->slitt_roll,1,0,'L');
            $this->Cell($w[3],7,$roll->kode_roll_slitt,1,0,'L');
            $this->Ln();
            $minimal--;
        }

        if($minimal > 0) {
            for ($i=1; $i <= $minimal; $i++) { 
                $this->Cell($w[0],7,$no++,1,0);
                $this->Cell($w[1],7,"",1,0,'L');
                $this->Cell($w[2],7,"",1,0,'L');
                $this->Cell($w[3],7,"",1,0,'L');
                $this->Ln();
            }
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
	}
 
	//Page footer
	function Footer()
	{
		
	}
}
 
//contoh pemanggilan class
$pdf = new PDF();
$pdf->SetTitle('LIST NCR');
//Header
$header = array('No', 'Customer', 'Kode Roll', 'No LOT');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Content($header, $rolls, $customer);
$pdf->Output();
