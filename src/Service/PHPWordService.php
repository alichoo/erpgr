<?php
// src/Service/PHPWordService.php
namespace App\Service;

use PhpOffice\PhpWord\PhpWord;
use \PhpOffice\PhpWord\TemplateProcessor;

class PHPWordService
{
    public function createPHPWord(): PhpWord
    {
        return new PhpWord();
    }
    public function gettemplate($doc='resources/presens.docx'):TemplateProcessor{
        $templateProcessor = new TemplateProcessor($doc);
        return $templateProcessor;
    }
}
?>
