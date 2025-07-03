<?php
//require_once('includes/autoload.php');
require_once __DIR__ . '/TCPDF/mpdf-development/vendor/autoload.php';
/*******************************************************************************
* Invoicr                                                                      *
*                                                                              *
* Version: 1.1.1	                                                               *
* Author:  EpicBrands BVBA                                    				   *
* http://www.epicbrands.be                                                     *
*******************************************************************************/
class invoicr 
{

	var $font = 'helvetica';
	var $columnOpacity = 0.06;
	var $columnSpacing = 0.3;
	var $referenceformat = array('.',',');
	var $margins = array('l'=>10,'t'=>20,'r'=>10);
    var $is_second = false;
	var $l;
	var $document;
	var $type;
	var $reference;
	var $logo;
	var $color;
	var $date;
	var $due;
	var $gst;
	var $from;
	var $name;
	var $to =[];
	var $ship; // ADDED SHIPPING
	var $items;
	var $items2;
	var $totals;
	var $badge;
	var $addText;
	var $amount_inword;
	var $footernote;
	var $dimensions;
	var $language = 'hindi'; // Default language
	
	/*******************************************************************************
	*                                                                              *
	*                               Public methods                                 *
	*                                                                              *
	*******************************************************************************/

	
	function setType($title)
	{
		$this->title = $title;
	}
	
	function setColor($rgbcolor)
	{
		$this->color = $this->hex2rgb($rgbcolor);
	}
	
	function setSecond($rgbcolor)
	{
		$this->is_second = $rgbcolor;
	}

	function setLanguage($lang)
	{
		$this->language = $lang; // 'hindi' or 'english'
	}
	
   function setinWord($rgbcolor)
	{
		$this->amount_inword = $rgbcolor;
	}
	
	function setDate($date)
	{
		$this->date = $date;
	}
	
	function setDue($date)
	{
		$this->due = $date;
	}
	
	function setLogo($logo=0,$maxWidth=0,$maxHeight=0)
	{
		if($maxWidth and $maxHeight) {
			$this->maxImageDimensions = array($maxWidth,$maxHeight);
		}
		$this->logo = $logo;
		$this->dimensions = $this->resizeToFit($logo);
	}
	
	function setFrom($data)
	{
		$this->from = array_filter($data);
        //print_r(array_filter($data));
	}
	
	function setTo($data)
	{
		$this->to = $data;
	}
	function setGST($data)
	{
		$this->gst = $data;
	}

	function shipTo($data)
	{
		$this->ship = $data;
	}
	
	function shipName($data)
	{
		$this->name = $data;
	}
	
	function setReference($reference)
	{
		$this->reference = $reference;
	}
	
	function setNumberFormat($decimals,$thousands_sep)
	{
		$this->referenceformat = array($decimals,$thousands_sep);
	}
	
	function flipflop()
	{
		$this->flipflop = true;
	}
	
	function addItem($item_product,$order_no,$publishing_date,$release_order_date,$alloted_space,$rate_value,$ad_price)
	{
		 
		$p['product'] 			= $this->br2nl($item_product);
	
		$p['order_no']			= $order_no;
		
		
		$p['release_order_date']			= $release_order_date;
		$p['publishing_date'] 		= $publishing_date;
		$p['alloted_space']			= $alloted_space;
		$p['rate_value']			= $rate_value;
		$p['ad_price']			= $ad_price;
		
		
		
		$this->items[]		= $p;
	}
	

	

	
	function addTotal($name,$value,$colored=0)
	{
		$t['name']			= $name;
		$t['value']			= $value;
		if(is_numeric($value)) {
			$t['value']			= $this->currency.' '.number_format($value,2,$this->referenceformat[0],$this->referenceformat[1]);
		} 
		$t['colored']		= $colored;
		$this->totals[]		= $t;
	}
	
	function addTitle($title) 
	{
		$this->addText[] = array('title',$title);
	}
	
	function addParagraph($paragraph) 
	{
		$paragraph = $this->br2nl($paragraph);
		$this->addText[] = array('paragraph',$paragraph);
	}
	
	function addBadge($badge)
	{
		$this->badge = $badge;
	}
	
	function setFooternote($note) 
	{
		$this->footernote = $note;
	}
	
	function render($name='',$destination='')
	{
		$this->AddPage("P", "A3");
		$this->Body();
		$this->AliasNbPages();
	 	$this->Output($name,$destination);
	}
	
    function htmlheader(){
        
        $html = "
            <html>
            <head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
            <style>
            body ,th ,td {font-family: freeserif;

            }
            table tr td {
                    white-space: nowrap;
                }
            table.content ,table.header {
                width:100%;
            }
            .customer-info td {
                white-space: normal !important;
                word-wrap: break-word;
                font-size: 40px !important;
            }
            .header-info td {
                font-size: 40px !important;
                white-space: nowrap;
            }
            
            .data-table th{border: 1px solid #dddddd;}
            .data-table td {
                word-wrap: break-word;
                white-space: normal;
                max-width: 150px;
            }
            </style> </head>";
            
        return $html;
    }
    
    function htmlfooter(){
        
    }
	
	function create_pdf($name){

	    $html = $this->htmlheader();
	     $mpdf = new \Mpdf\Mpdf();

	   // Get language-specific header logo
	   $header_logo = ($this->language == 'english') ? HEADER_LOGO_ENGLISH : HEADER_LOGO_HINDI;

	   $html .= '<div>

	   <img src="http://invoice.tirthrajtimes.com/'.$header_logo.'">

	   </div>
	   
	   <!-- Header Information Table -->
	   <table class="table header-info" style="width:100%; margin-bottom:20px;">
	   <tr>
        <td style="font-size:40px; text-align:left; width:33%;"><label><b>Bill No.: '.$this->reference.'</b></label></td>
        <td style="font-size:40px; text-align:center; width:34%;"><label><b>'.GSTNO.'</b></label></td>
        <td style="font-size:40px; text-align:right; width:33%;"><label><b>Date: '.$this->date.'</b></label></td>
    </tr>
</table>

<!-- Customer Information Table -->
<table class="table customer-info" style="width:100%; margin-bottom:20px;">
    <tr>
        <td style="font-size:40px; text-align:left; padding-bottom:10px;"><b>To,</b></td>
    </tr>
    <tr>
        <td style="font-size:40px; padding-left:15px; padding-bottom:5px; word-wrap:break-word; white-space:normal;"><b>'.$this->to["name"].'</b></td>
    </tr>
    <tr>
        <td style="font-size:40px; padding-left:15px; word-wrap:break-word; white-space:normal;"><b>'.$this->to["add"].'<br>GST NO.: '.$this->gst.'</b></td>
    </tr>
</table>
<br><br>

<table class="data-table" style="border: 1px solid;width:100%;border-collapse: collapse;border-spacing: 1px;"><thead><tr>';
 if($this->is_second){
    $html .='<th style="padding:3px; font-size:14px;">Bill No. </th><th style="padding:3px; font-size:14px;">  Date  </th>';
  } else {
    $html .='<th style="padding:3px; font-size:14px;">Details </th>';  
  }
  
  $html .='<th style="padding:3px; font-size:14px;">R.O. No.</th>
  <th style="padding:3px; font-size:14px;">R.O. Issued Date </th>
  <th style="padding:3px; font-size:14px;">Date of Publication </th>
  <th style="padding:3px; font-size:14px;">Allotted Area (Sq. cms.) </th>
  <th style="padding:3px; font-size:14px;">Rate (Per Sq. cms.) </th>
  <th style="padding:3px; font-size:14px;">Advertisement Cost </th>';
   $html .="</thead><tbody>";
	if($this->items) {
	    $i=1;
			foreach($this->items as $item) 
			{
             $html .= '<tr style="border: 1px solid #dddddd;">';
            if($this->is_second){
               $html .='<td style="border: 1px solid #dddddd; font-size:14px;">'.$this->reference.'</td><td style="border: 1px solid #dddddd; font-size:14px;">'.$this->date.'</td>';
            } else {
             $html .='<td style="border: 1px solid #dddddd; font-size:14px; word-wrap:break-word; white-space:normal; max-width:150px;">'.$item['product'].'</td>';
            }
       $html .='<td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['order_no'].'</td><td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['release_order_date'].'</td>
       
            <td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['publishing_date'].'</td>
            <td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['alloted_space'].'</td>
            <td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['rate_value'].'</td>
            <td style="border: 1px solid #dddddd; font-size:14px;" align="center">'.$item['ad_price'].'</td>
          
           </tr>';

}}


$html .= '</tbody></tr>
</thead></table>
<table style="width:100%;border-collapse: collapse;">';
foreach($this->totals as $total) {
    
 $html .='<tr><td  style="width:400px">&nbsp;</td><td align="left" style="border: 1px solid #dddddd;text-align:left;width:190px; font-size:16px;"><b>'.strtoupper($total['name']).'</b></td><td align="right" style="width:300px;border: 1px solid #dddddd;text-align:right; font-size:19px;">'.$total['value'].'</td></tr>';
}
$html .='</table><br>
<hr style="height:3px; background:#221F20;">
<table>
<tr><td style="width:650px"></td></tr>
<tr><td style="width:430px font-size:16px;"><b>Total Amount:'.$this->amount_inword.'</b></td></tr></table>';


// Get language-specific payment details and signature
$payment_details = ($this->language == 'english') ? PAYMENT_DETAILS_ENGLISH : PAYMENT_DETAILS_HINDI;
$signature_image = ($this->language == 'english') ? SIGNATURE_IMAGE_ENGLISH : SIGNATURE_IMAGE_HINDI;
$terms_of_service = ($this->language == 'english') ? TERMS_OF_SERVICE_ENGLISH : TERMS_OF_SERVICE_HINDI;

$html .='<br><table><tr><td style="width:500px; font-size:18px;"><b>'.$payment_details.'</b></td><td align="right" style="width:400px; font-size:15px;">
<img src="http://invoice.tirthrajtimes.com/'.$signature_image.'"/><br>
</td></tr></table>';
if($this->is_second){
   $html .='<br><table><tr><td style="font-size:15px;">'.$terms_of_service.'</td></tr></table>';
}



$html .='</div>';
	    

        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->WriteHTML($html);
        
        //call watermark content aand image
       // $mpdf->SetWatermarkText('invoice');
        //$mpdf->showWatermarkText = true;
        //$mpdf->watermarkTextAlpha = 0.1;
      //  $mpdf->Output("phpflow.pdf", 'F');
      
        $mpdf->Output("invoices/".$name ,"F");
        
        //exit;
	    
	}
	
	
	
	
	/*******************************************************************************
	*                                                                              *
	*                               Create Invoice                                 *
	*                                                                              *
	*******************************************************************************/
	function Headerss()
	{
	    if(isset($this->logo)) {
	    	$this->Image($this->logo,$this->margins['l'],$this->margins['t'],$this->dimensions[0],$this->dimensions[1]);
	    }

	    //Title
		$this->SetTextColor(0,0,0);
		$this->SetFont($this->font,'B',20);
	    $this->Cell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper($this->title)),0,1,'R');
		$this->SetFont($this->font,'',9);
		$this->Ln(5);
		
		$lineheight = 5;
		//Calculate position of strings
		$this->SetFont($this->font,'B',9);	
		$positionX = $this->document['w']-$this->margins['l']-$this->margins['r']-max(strtoupper($this->GetStringWidth($this->l['number'])),strtoupper($this->GetStringWidth($this->l['date'])),strtoupper($this->GetStringWidth($this->l['due'])))-35;
		
	    //Number
	    $this->Cell($positionX,$lineheight);
	    
	    $this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
		
		
		$this->SetTextColor(50,50,50);
		$this->SetFont($this->font,'',9);
	//	$this->Cell(35,$lineheight,$this->reference,0,1,'R');
		
		//Date
		$this->Cell($positionX,$lineheight);
		$this->SetFont($this->font,'B',9);
		$this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
		//$this->Cell(82,$lineheight,iconv("UTF-8", "ISO-8859-1",strtoupper($this->l['date'])).':',0,0,'L');	
		$this->SetTextColor(50,50,50);
		$this->SetFont($this->font,'',9);
		$this->Cell(0,$lineheight,date("d/m/Y"),0,1,'R');
		
		
		$this->Cell(20,20,'',0,0,'L');
		$this->Cell(32,30,iconv("UTF-8", "ISO-8859-1",$this->reference),0,0,'L');
		
		$this->Cell(50,20,'',0,0,'L');
		$this->Cell(112,30,iconv("UTF-8", "ISO-8859-1",'GSTNo-'.$this->gst),0,0,'L');
	    //$this->Cell(118,30,iconv("UTF-8", "ISO-8859-1","BILLING DATE:"),0,0,'L');
	    $this->Cell(102,30,iconv("UTF-8", "ISO-8859-1",$this->date),0,0,'L');
		
		//First page
		if($this->PageNo()==1) 
		{
		
			if(($this->margins['t']+$this->dimensions[1]) > $this->GetY()) 
			{
				$this->SetY($this->margins['t']+$this->dimensions[1]+10);
			} 
			else 
			{
				$this->SetY($this->GetY()+10);
			}
			$this->Ln(5);
			$this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
			$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
			$this->SetFont($this->font,'B',10);
			$width = ($this->document['w']-$this->margins['l']-$this->margins['r'])/3;
			if(isset($this->flipflop))
			{
				$to = $this->l['to'];
				$from = $this->l['from'];
				$ship = $this->l['ship']; // ADDED SHIPPING

				$this->l['to'] = $from;
				$this->l['from'] = $to;
				$this->l['ship'] = $from; // ADDED SHIPPING

				$to = $this->to;
				$from = $this->from;
				$ship = $this->ship; // ADDED SHIPPING

				$this->to = $from;
				$this->from = $to;
				$this->ship = $from; // ADDED SHIPPING
			}
		   
		    $this->Cell(5,$lineheight,'',0,0,'L');
			$this->Cell(10,$lineheight,"To,",0,0,'L');
			$this->Cell(35,$lineheight,'',0,0,'L');
			$this->Cell(35,$lineheight,'',0,0,'L');
			$this->Cell(35,$lineheight,'',0,0,'L');
			$this->Cell(38,$lineheight,'',0,0,'L');
			$this->Cell(42,$lineheight,strtoupper("Address :"),0,0,'L');
			//$this->Cell(0,$lineheight,strtoupper($this->l['ship']),0,0,'L'); // ADDED SHIPPING
			$this->Ln(7);
			$this->SetLineWidth(0.3);
		
			//$this->Line($this->margins['l'], $this->GetY(),$this->margins['l']+$width-10, $this->GetY());
			$this->Cell(35,$lineheight,'',0,0,'L');
			$this->Cell(35,$lineheight,'',0,0,'L');
		//	$this->Line($this->margins['l']+$width, $this->GetY(),$this->margins['l']+$width+$width+$width, $this->GetY());

			//Information
			$this->Ln(5);
			$this->SetTextColor(50,50,50);
			$this->SetFont($this->font,'B',10);
			$this->Cell(13,$lineheight,'',0,0,'L');
			$this->Cell($width,$lineheight,$this->to[0],0,0,'L');
			
			$this->Cell(35,$lineheight,'',0,0,'L');
			$this->Cell(36,$lineheight,'',0,0,'L');
			$this->Cell(18,$lineheight,'',0,0,'L');
			$this->Cell(22,$lineheight,$this->from[0],0,0,'L');
		//	$this->Cell(0,$lineheight,$this->ship[0],0,0,'L'); // ADDED SHIPPING
			$this->SetFont($this->font,'',8);
			$this->SetTextColor(100,100,100);
			$this->Ln(7);
			for($i=1; $i<max(count($this->from),count($this->to)); $i++) { // ADDED SHIPPING
			    $this->Cell(15,$lineheight,'',0,0,'L');
				$this->Cell(80,$lineheight,iconv("UTF-8", "ISO-8859-1",$this->to[$i]),1,0,'L');
				
			
				$this->Cell(65,$lineheight,'',0,0,'L');
				$this->Cell(75,$lineheight,iconv("UTF-8", "ISO-8859-1",$this->from[$i]),1,0,'L');
				//$this->Cell(0,$lineheight,iconv("UTF-8", "ISO-8859-1",$this->ship[$i]),0,0,'L'); // ADDED SHIPPING
				$this->Ln(5);
			}	
			$this->Ln(-6);
		}
		$this->Ln(5);
		
		//Table header
		if(!isset($this->productsEnded)) 
		{
			$width_other = ($this->document['w']-$this->margins['l']-$this->margins['r']-$this->firstColumnWidth-($this->columns*$this->columnSpacing))/($this->columns-1);
			$this->SetTextColor(50,50,50);
			$this->Ln(20);
			$this->SetFont($this->font,'B',9);
			$this->Cell(15,10,'Sr. No.',1,0,'L',0);
			if($this->is_second){
    			$this->Cell(36,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Invoice No.")),1,0,'L',0);
    			$this->Cell($this->columnSpacing,17,'',0,0,'L',0);
    			$this->Cell(40,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Billing Date")),1,0,'C',0);
			} else{
			    $this->Cell($this->columnSpacing,17,'',0,0,'L',0);
		     	$this->Cell(76,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Product")),1,0,'C',0);
			}
			
			$this->Cell($this->columnSpacing,27,'',0,0,'L',0);
			$this->Cell(32,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Release Ord. No.")),1,0,'C',0);
			$this->Cell($this->columnSpacing,24,'',0,0,'L',0);
			$this->Cell(40,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Release Order date")),1,0,'C',0);
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell(31,10,iconv("UTF-8", "ISO-8859-1",strtoupper("publishing date")),1,0,'C',0);
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell(30,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Alloted Space")),1,0,'C',0);
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell(13,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Rate")),1,0,'C',0);
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell(30,10,iconv("UTF-8", "ISO-8859-1",strtoupper("Adv. Price")),1,0,'C',0);
		
			$this->Ln();
			$this->SetLineWidth(0.4);
			$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
			$this->Line($this->margins['l'], $this->GetY(),$this->document['w']-$this->margins['r'], $this->GetY());
			$this->Ln(2);	
		} else 
		{
			$this->Ln(12);	
		}
	}
	
	function Bodyss()
	{	
		$width_other = ($this->document['w']-$this->margins['l']-$this->margins['r']-$this->firstColumnWidth-($this->columns*$this->columnSpacing))/($this->columns-1);
		$cellHeight = 9;
		$bgcolor = (1-$this->columnOpacity)*255;
		$i=1;
		if($this->items) {
			foreach($this->items as $item) 
			{
				
				$cHeight = $cellHeight;
				$this->SetFont($this->font,'b',8);
				$this->SetTextColor(50,50,50);
				$this->SetFillColor($bgcolor,$bgcolor,$bgcolor);
				$this->Cell(15,$cHeight,$i,1,0,'L',1);
				$x = $this->GetX();
				if($this->is_second){
					$this->Cell(36,$cHeight,$this->reference,1,0,'L',1);
					$this->Cell(40,$cHeight,$this->date,1,0,'L',1);
				}else{
				
				   $this->Cell(76,$cHeight,iconv("UTF-8", "ISO-8859-1",$item['product']),1,0,'L',1);
				}
				$this->Cell(32,$cHeight,iconv("UTF-8", "ISO-8859-1",$item['order_no']),1,0,'C',1);
				
				$this->SetTextColor(50,50,50);
				$this->SetFont($this->font,'',8);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				$this->Cell(40,$cHeight,$item['release_order_date'],1,0,'C',1);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				$this->Cell(31,$cHeight,iconv('UTF-8', 'windows-1252', $item['publishing_date']),1,0,'C',1);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				$this->Cell(30,$cHeight,iconv('UTF-8', 'windows-1252', $item['alloted_space']),1,0,'C',1);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				$this->Cell(14,$cHeight,iconv('UTF-8', 'windows-1252', $item['rate_value']),1,0,'C',1);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				$this->Cell(30,$cHeight,iconv('UTF-8', 'windows-1252', $item['ad_price']),1,0,'R',1);
				$this->Cell($this->columnSpacing,$cHeight,'',0,0,'L',0);
				
				
				$this->Ln();
				$this->Ln($this->columnSpacing);
				$i++;
			}
		}
		$badgeX = $this->getX();
		$badgeY = $this->getY();
		
		//Add totals
		if($this->totals) 
		{
		   
			foreach($this->totals as $total) 
			{
				$this->SetTextColor(50,50,50);
				$this->SetFillColor(255,255,255);
				$this->Cell(1+$this->firstColumnWidth,$cellHeight,'',0,0,'L',0);
				for($i=0;$i<$this->columns-3;$i++) 
				{
					$this->Cell($width_other,$cellHeight,'',0,0,'L',0);
					$this->Cell($this->columnSpacing,$cellHeight,'',0,0,'L',0);
				}
				$this->Cell($this->columnSpacing,$cellHeight,'',0,0,'L',0);
				if($total['colored']) 
				{
					$this->SetTextColor(255,255,255);
					$this->SetFillColor($this->color[0],$this->color[1],$this->color[2]);
				}
			
				$this->SetFont($this->font,'b',8);
				
			
				$this->Cell(93,$cellHeight,iconv('UTF-8', 'windows-1252',$total['name']),1,0,'C',1);
				$this->Cell($this->columnSpacing,$cellHeight,'',0,0,'L',0);
				$this->SetFont($this->font,'b',8);
				$this->SetFillColor(255,255,255);
				if($total['colored']) 
				{
					$this->SetTextColor(255,255,255);
					$this->SetFillColor($this->color[0],$this->color[1],$this->color[2]);
				}
				
				$this->Cell(30,$cellHeight,iconv('UTF-8', 'windows-1252',$total['value']),1,1,'R',1);
				$this->Ln();
				$this->Ln($this->columnSpacing);
			}
		}
		$this->productsEnded = true;
		$this->Ln();
	//	$this->SetFont($this->font,'b',9);
				$this->SetTextColor(50,50,50);
				$this->Cell(0,0,iconv("UTF-8", "ISO-8859-1",strtoupper("Amount in words : ".' '.$this->amount_inword)),0,1,'L',0);
			
				$this->SetLineWidth(0.3);
				$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
			//	$this->Line($this->margins['l'], $this->GetY()-10,$this->document['w']-$this->margins['r'], $this->GetY());
				$this->Ln(5);
		
		
		//Badge
		if($this->badge) 
		{
			$badge = ' '.strtoupper($this->badge).' ';
			$resetX = $this->getX();
			$resetY = $this->getY();
			$this->setXY($badgeX,$badgeY+15);
			$this->SetLineWidth(0.4);
			$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);		
			$this->setTextColor($this->color[0],$this->color[1],$this->color[2]);
			$this->SetFont($this->font,'b',15);
			$this->Rotate(10,$this->getX(),$this->getY());
			$this->Rect($this->GetX(),$this->GetY(),$this->GetStringWidth($badge)+2,10);
			$this->Write(10,$badge);
			$this->Rotate(0);
			if($resetY>$this->getY()+20) 
			{
				$this->setXY($resetX,$resetY);
			} 
			else 
			{
				$this->Ln(18);
			}
		}

		
	
		//Add information
		foreach($this->addText as $text) 
		{
			if($text[0] == 'title') 
			{
				$this->SetFont($this->font,'b',9);
				$this->SetTextColor(50,50,50);
				$this->Cell(0,10,iconv("UTF-8", "ISO-8859-1",strtoupper($text[1])),0,0,'L',0);
				$this->Ln();
				$this->SetLineWidth(0.3);
				$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
				$this->Line($this->margins['l'], $this->GetY(),$this->document['w']-$this->margins['r'], $this->GetY());
				$this->Ln(4);
			}
			if($text[0] == 'paragraph') 
			{
				$this->SetTextColor(80,80,80);
				$this->SetFont($this->font,'',8);
				$this->MultiCell(0,4,iconv("UTF-8", "ISO-8859-1",$text[1]),0,'L',0);
				$this->Ln(4);
			}
		}
	  
	}
	
	
	function Footersss()
	{
		$this->SetY(-$this->margins['t']);
		$this->SetFont($this->font,'',8);
		$this->SetTextColor(50,50,50);
		
		$this->Cell(0,10,$this->footernote,0,0,'L');
		$this->Cell(0,10,$this->l['page'].' '.$this->PageNo().' '.$this->l['page_of'].' {nb}',0,0,'R');
	}
	
	/*******************************************************************************
	*                                                                              *
	*                               Private methods                                *
	*                                                                              *
	*******************************************************************************/
	private function setLanguagess($language)
	{
		$this->language = $language;
		include('languages/'.$language.'.inc');
		$this->l = $l;
	}
	
	private function setDocumentSizess($dsize)
	{
		switch ($dsize)
		{
			case 'A4':
				$document['w'] = 210;
				$document['h'] = 297;
				break;
			case 'letter':
				$document['w'] = 215.9;
				$document['h'] = 279.4;
				break;
			case 'legal':
				$document['w'] = 215.9;
				$document['h'] = 355.6;
				break;
			default:
				$document['w'] = 210;
				$document['h'] = 297;
				break;
		}
		$this->document = $document;
	}
	
	private function resizeToFit($image)
	{
		list($width, $height) = getimagesize($image);
		$newWidth = $this->maxImageDimensions[0]/$width;
		$newHeight = $this->maxImageDimensions[1]/$height;
		$scale = min($newWidth, $newHeight);
		return array(
			round($this->pixelsToMM($scale * $width)),
			round($this->pixelsToMM($scale * $height))
		);
	}
	    
	private function pixelsToMM($val) 
	{
		$mm_inch = 25.4;
		$dpi = 96;
		return $val * $mm_inch/$dpi;
	}
	
	private function hex2rgb($hex)
	{
	   $hex = str_replace("#", "", $hex);
	
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return $rgb;
	}
	
	private function br2nl($string)
	{
    	return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	}  

}

?>