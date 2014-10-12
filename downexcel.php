<?php

/**
 * Simple excel generating from PHP5
 *
 * @package Utilities
 * @license http://www.opensource.org/licenses/mit-license.php
 * @author Oliver Schwarz <oliver.schwarz@gmail.com>
 * @version 1.0
 */

/**
 * Generating excel documents on-the-fly from PHP5
 * 
 * Uses the excel XML-specification to generate a native
 * XML document, readable/processable by excel.
 * 
 * @package Utilities
 * @subpackage Excel
 * @author Oliver Schwarz <oliver.schwarz@vaicon.de>
 * @version 1.1
 * 
 * @todo Issue #4: Internet Explorer 7 does not work well with the given header
 * @todo Add option to give out first line as header (bold text)
 * @todo Add option to give out last line as footer (bold text)
 * @todo Add option to write to file
 */
class Excel_XML
{

    /**
     * Header (of document)
     * @var string
     */
        private $header = "<?xml version=\"1.0\" encoding=\"%s\"?\>\n<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\" xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

        /**
         * Footer (of document)
         * @var string
         */
        private $footer = "</Workbook>";

        /**
         * Lines to output in the excel document
         * @var array
         */
        private $lines = array();

        /**
         * Used encoding
         * @var string
         */
        private $sEncoding;
        
        /**
         * Convert variable types
         * @var boolean
         */
        private $bConvertTypes;
        
        /**
         * Worksheet title
         * @var string
         */
        private $sWorksheetTitle;

        /**
         * Constructor
         * 
         * The constructor allows the setting of some additional
         * parameters so that the library may be configured to
         * one's needs.
         * 
         * On converting types:
         * When set to true, the library tries to identify the type of
         * the variable value and set the field specification for Excel
         * accordingly. Be careful with article numbers or postcodes
         * starting with a '0' (zero)!
         * 
         * @param string $sEncoding Encoding to be used (defaults to UTF-8)
         * @param boolean $bConvertTypes Convert variables to field specification
         * @param string $sWorksheetTitle Title for the worksheet
         */
        public function __construct($sEncoding = 'UTF-8', $bConvertTypes = false, $sWorksheetTitle = 'Table1')
        {
                $this->bConvertTypes = $bConvertTypes;
            $this->setEncoding($sEncoding);
            $this->setWorksheetTitle($sWorksheetTitle);
        }
        
        /**
         * Set encoding
         * @param string Encoding type to set
         */
        public function setEncoding($sEncoding)
        {
            $this->sEncoding = $sEncoding;
        }

        /**
         * Set worksheet title
         * 
         * Strips out not allowed characters and trims the
         * title to a maximum length of 31.
         * 
         * @param string $title Title for worksheet
         */
        public function setWorksheetTitle ($title)
        {
                $title = preg_replace ("/[\\\|:|\/|\?|\*|\[|\]]/", "", $title);
                $title = substr ($title, 0, 31);
                $this->sWorksheetTitle = $title;
        }

        /**
         * Add row
         * 
         * Adds a single row to the document. If set to true, self::bConvertTypes
         * checks the type of variable and returns the specific field settings
         * for the cell.
         * 
         * @param array $array One-dimensional array with row content
         */
        private function addRow ($array)
        {
            $cells = "";
            $title = '';
                foreach ($array as $k => $v):
                        $type = 'String';
                        if ($this->bConvertTypes === true && is_numeric($v)):
                                $type = 'Number';
                        endif;
                        $v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
                        //$cells .= "<Cell ss:StyleID=\"s29\"><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n";
                        $cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n";
                endforeach;
                //$this->lines[] = "<Row ss:AutoFitHeight=\"0\">\n" . $cells . "</Row>\n";
                $this->lines[] = $cells;
        }

        /**
         * Add an array to the document
         * @param array 2-dimensional array
         */
        public function addArray ($array)
        {
                foreach ($array as $k => $v)
                        $this->addRow ($v);
        }

        /**
         * Generate the excel file
         * @param string $filename Name of excel file to generate (...xls)
         */
        public function generateXML ($filename = 'excel-export')
        {
                // correct/validate filename
                //$filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
                //$filename = urlencode($filename);    
                //$filename = str_replace("+", "%20", $filename);// 替换空格
        
                // deliver header (as recommended in php manual)
                header("Pragma: public");   header("Expires: 0"); 
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
                header("Content-Type: application/force-download"); 
                header("Content-Type: application/vnd.ms-excel; charset=".$this->sEncoding.""); 
                header("Content-Transfer-Encoding: binary"); 

                //header("Content-Disposition: attachment; filename=\"" . $filename . ".xls\"");
                // 文件名乱码问题
                if (preg_match("/MSIE/", $_SERVER["HTTP_USER_AGENT"])) {    
                    $filename = urlencode($filename);    
                    $filename = str_replace("+", "%20", $filename);// 替换空格    
                    header("Content-Disposition: attachment; filename=\"{$filename}.xls\"; charset=".$this->sEncoding."");
                } else if (preg_match("/Firefox/", $_SERVER["HTTP_USER_AGENT"])) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename. '.xls"');
                } else {    
                    header("Content-Disposition: attachment; filename=\"{$filename}.xls\"; charset=".$this->sEncoding."");
                }

                // print out document to the browser
                // need to use stripslashes for the damn ">"
                echo stripslashes (sprintf($this->header, $this->sEncoding));
                echo "<Styles>
                      <Style ss:ID=\"s21\">
                       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
                       <Font ss:FontName=\"宋体\" x:CharSet=\"134\" ss:Size=\"14\" ss:Bold=\"1\"/>
                      </Style>
                      <Style ss:ID=\"s25\">
                        
                      </Style>
                      <Style ss:ID=\"s29\">
                       <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
                       <Borders>
                        <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
                        <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
                        <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
                        <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"1\"/>
                       </Borders>
                      </Style>
                    </Styles>";
                echo "\n<Worksheet ss:Name=\"" . $this->sWorksheetTitle . "\">\n<Table x:FullColumns=\"1\" x:FullRows=\"1\" ss:DefaultColumnWidth=\"120\" ss:DefaultRowHeight=\"17.25\">\n";
                $count = count($this->lines);
                foreach ($this->lines as $k =>$line)
                    if($k == 0){
                        echo "<Row ss:AutoFitHeight=\"0\" ss:StyleID=\"s21\">\n".$line."</Row>\n";
                    }else{
                        echo "<Row ss:AutoFitHeight=\"0\" ss:StyleID=\"s29\">\n".$line."</Row>\n";
                    }
                    //echo $line;

                echo "</Table>\n</Worksheet>\n";
                echo $this->footer;
        }

}

//引用此类import('php-excel.class.php');
//报表头：$data = array( 1=>array('列一','列二','列三'));
//$data[] = arrya($list);报表内容
//$xls = new Excel_XML('UTF-8', false, '用户列表');//sheet名
//$xls->addArray($data);//数据
//$xls->generateXML($instname.'用户列表');//文件名
