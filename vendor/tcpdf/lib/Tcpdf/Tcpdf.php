<?php
# vendor/tcpdf/lib/Tcpdf/Tcpdf.php

require_once __DIR__.'/src/tcpdf.php';

class Tcpdf_Tcpdf extends TCPDF 
{
    /* --- */

    private $isRevi = false;
    private $isTabl = false;
    private $isMkLateral = false;
    private $entity = null; 
    private $memoTitle = "None";
    
    public function getDir()
	{
		return __DIR__.'/src';
	}
	
    public function Header() 
    {
        // Logo
        $image_file = K_PATH_IMAGES.'tcpdf_logo.jpg';
        $this->Image($image_file, 20, 15, 47, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 20);

        if($this->isRevi)
        {
            $html = '<table style="border-bottom: 3px solid #063166;">';
            $html .= '<tr><td><b>No: '.$this->entity->getId().'</b></td><td><b>Fecha: '.$this->entity->getFecha()->format('Y-m-d').'</b></td></tr>';
            $html .= '<tr><td><b>'.$this->entity->getMdpaci()->getIdentificacion().'</b></td>';
            $html .= '<td><b>'.$this->entity->getMdpaci()->getFullName().'</b></td></tr>';
            $html .= '<tr><td><b>'.$this->entity->getMdpaci()->getGbptra()->getNombre().'</b></td>';
            $html .= '<td><b>'.$this->entity->getMdpaci()->getGbSucu()->getGbempr()->getNombre().'</b></td></tr>';
            $html .= '<tr><td colspan="2"><i>Salud Control V 1.0</i></td></tr>';
            $html .= '</table>';
            
            $this->SetFont('helvetica','',10);
            $this->writeHTMLCell(0, 0, 20, 17, $html, 0, 1, 0, true, 'R', true);
        }

        if($this->isTabl)
        {
            $hoy = new \DateTime();

            $html = '<table style="border-bottom: 3px solid #063166;">';
            $html .= '<tr><td>&nbsp;</td></tr>';
            $html .= '<tr><td>'.$this->memoTitle.'</td></tr>';
            $html .= '<tr><td><b>'.$hoy->format('Y-m-d').'</b></td></tr>';
            $html .= '<tr><td><i>Salud Control V 1.0</i></td></tr>';
            $html .= '</table>';
            
            $this->SetFont('helvetica','',10);
            $this->writeHTMLCell(0, 0, 20, 17, $html, 0, 1, 0, true, 'R', true);   
        }
    }

    public function Footer()
    {
        $this->SetY(-1*$this->footer_margin);
        // Set font
        $this->SetFont('helvetica', 'B', 8);
        $html = '<table style="border-top: 3px solid #063166;">';
        $html .= '<tr><td>Página: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'</td></tr>';
        $html .= '<tr><td><b>VIMELAB, S.L. C/ Pi i MARGALL, n. 25, Esc. B, entr. 1ª · Tel. 93 449 31 61 · Fax. 93 334 60 72 · 08042 BARCELONA</b></td></tr>';
        $html .= '<tr><td>vimelab@vimelab.com / www.vimelab.com</td></tr>';
        $html .= '</table>';
        $this->writeHTMLCell(0, 0, 20, $this->GetY(), $html, 0, 1, 0, true, 'C', true);
        
        if($this->isMkLateral)
            $this->mkLateral();
    }

    private function mkLateral()
    {
        $this->SetTextColor(6, 49, 102);
        $this->StartTransform();
        $this->Rotate(90, 10, $this->getPageHeight()*0.75);
        $this->Text(10, ($this->getPageHeight()*0.75)-4, 'R. M. de Barcelona · Tomo 14.157 · Folio 67 · Hoja/Dup. 241948 · Inscripción 1ª · N.I.F. B-62809306 ');
        $this->StopTransform();
    }

    public function setRevi($val)
    {
        $this->isRevi = $val;
    }

    public function setMemoTitle($val)
    {
        $this->memoTitle = $val;
    }

    public function setTabl($val)
    {
        $this->isTabl = $val;   
    }

    public function setMkLateral($val)
    {
        $this->isMkLateral = $val;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    public function autoCell($w, $h, $x, $y, $html = '', $border = 0 , $ln = 0, $fill = false, $reseth = true, $align = '', $autopadding = true)
    {
        if(($this->y+40) >= $this->h)
        {
            $this->AddPage();
            $y = $this->GetY();
        }
        
        $this->writeHTMLCell($w, $h, $x, $y, $html, $border, $ln, $fill, $reseth, $align, $autopadding);
    }
} 
