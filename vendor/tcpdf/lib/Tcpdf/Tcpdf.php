<?php
# vendor/tcpdf/lib/Tcpdf/Tcpdf.php

require_once __DIR__.'/src/tcpdf.php';

class Tcpdf_Tcpdf extends TCPDF 
{
    /* --- */
    
    public function getDir()
	{
		return __DIR__.'/src';
	}
	
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'tcpdf_logo.jpg';
        $this->Image($image_file, 20, 15, 47, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 20);
    }
} 
