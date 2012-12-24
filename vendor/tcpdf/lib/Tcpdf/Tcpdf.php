<?php
# vendor/tcpdf/lib/Tcpdf/Tcpdf.php

require_once __DIR__.'/src/tcpdf.php';

class Tcpdf_Tcpdf extends TCPDF 
{
    /* --- */

    private $isRevi = false;
    private $entity = null;
    
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
            $html = '<table>';
            $html .= '<tr><td><b>No: '.$this->entity->getId().'</b></td><td><b>Fecha: '.$this->entity->getFecha()->format('Y-m-d').'</b></td></tr>';
            $html .= '<tr><td><b>'.$this->entity->getMdpaci()->getIdentificacion().'</b></td>';
            $html .= '<td><b>'.$this->entity->getMdpaci()->getFullName().'</b></td></tr>';
            $html .= '<tr><td><b>'.$this->entity->getMdpaci()->getGbptra()->getNombre().'</b></td>';
            $html .= '<td><b>'.$this->entity->getMdpaci()->getGbSucu()->getGbempr()->getNombre().'</b></td></tr>';
            $html .= '<tr><td colspan="2"><i>Salud Control V 1.0</i></td></tr>';
            $html .= '</table>';
            
            $this->SetFont('helvetica','',10);
            $this->writeHTMLCell(170, 0, 20, 17, $html, 0, 0, 0, true, 'R', true);
        }
    }

    public function setRevi($val)
    {
        $this->isRevi = $val;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }
} 
