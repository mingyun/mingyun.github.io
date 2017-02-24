###[php 下载excel]()
```js
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
                foreach ($array as $k => $v):
                        $type = 'String';
                        if ($this->bConvertTypes === true && is_numeric($v)):
                                $type = 'Number';
                        endif;
                        $v = htmlentities($v, ENT_COMPAT, $this->sEncoding);
                        $cells .= "<Cell><Data ss:Type=\"$type\">" . $v . "</Data></Cell>\n"; 
                endforeach;
                $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
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
                $filename = preg_replace('/[^aA-zZ0-9\_\-]/', '', $filename);
    	
                // deliver header (as recommended in php manual)
                header("Content-Type: application/vnd.ms-excel; charset=" . $this->sEncoding);
                header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");

                // print out document to the browser
                // need to use stripslashes for the damn ">"
                echo stripslashes (sprintf($this->header, $this->sEncoding));
                echo "\n<Worksheet ss:Name=\"" . $this->sWorksheetTitle . "\">\n<Table>\n";
                foreach ($this->lines as $line)
                        echo $line;

                echo "</Table>\n</Worksheet>\n";
                echo $this->footer;
        }

}
function exportstatAction(){
        $begintime = date('Y-m-d')." 00:00:00";
        $endtime = date('Y-m-d')." 23:59:59";
        $where = array();
        
        $data = array();
        $data[0] = array('ID','昵称','电话');
        $user_arr = array(
        	array('id'=>100,'nick_name'=>'jack','mobile'=>189),
        	array('id'=>110,'nick_name'=>'jack','mobile'=>159),
        	array('id'=>120,'nick_name'=>'jack','mobile'=>129),
        	array('id'=>130,'nick_name'=>'jack','mobile'=>139),
        	array('id'=>140,'nick_name'=>'jack','mobile'=>149),
        );
        $count = count($user_arr);
        
        for($i=0;$i<$count;$i++){
            $tmp_arr = array();
            $tmp_arr['id'] = $user_arr[$i]['id'];
            $tmp_arr['nick_name'] = $user_arr[$i]['nick_name'];
            $tmp_arr['mobile'] = $user_arr[$i]['mobile'];
   
            array_push($data,$tmp_arr);
        }
        //include_once("php-excel.class.php");
        $xls = new Excel_XML('UTF-8', false, '统计');
        $xls->addArray($data);
        $xls->generateXML('reg_'.date('Y-m-d'));
    }
```
###[php中文汉字转拼音首字母的PHP简易实现方法](http://chenall.net/)
```js
/*
    中文汉字转拼音首字母的PHP简易实现方法.
    要求: 只能是GB2312码表里面中文字符
    转换得到字符串对应的拼音首字母大写.
    来源: http://chenall.net/
    用法:
    echo zh2py::conv('Chinese 中华人民共和国');//Chinese ZHRMGHG
    或
    $py = new zh2py;
    echo $py->conv('Chinese 中华人民共和国');//Chinese ZHRMGHG
*/
class zh2py
{
    //根据汉字区位表,(http://www.mytju.com/classcode/tools/QuWeiMa_FullList.asp)
    //我们可以看到从16-55区之间是按拼音字母排序的,所以我们只需要判断某个汉字的区位码就可以得知它的拼音首字母.
    //区位表第一部份,按拼音字母排序的.
    //16区-55区
    /*
    	'A'=>0xB0A1, 'B'=>0xB0C5, 'C'=>0xB2C1, 'D'=>0xB4EE, 'E'=>0xB6EA, 'F'=>0xB7A2, 'G'=>0xB8C1,'H'=>0xB9FE,
	'J'=>0xBBF7, 'K'=>0xBFA6, 'L'=>0xC0AC, 'M'=>0xC2E8, 'N'=>0xC4C3, 'O'=>0xC5B6, 'P'=>0xC5BE,'Q'=>0xC6DA,
	'R'=>0xC8BB, 'S'=>0xC8F6, 'T'=>0xCBFA, 'W'=>0xCDDA, 'X'=>0xCEF4, 'Y'=>0xD1B9, 'Z'=>0xD4D1
    */
    private static $FirstTable = array(
	0xB0C5, 0xB2C1, 0xB4EE, 0xB6EA, 0xB7A2, 0xB8C1, 0xB9FE, 0xBBF7, 0xBFA6, 0xC0AC, 0xC2E8,
	0xC4C3, 0xC5B6, 0xC5BE, 0xC6DA, 0xC8BB, 0xC8F6, 0xCBFA, 0xCDDA, 0xCEF4, 0xD1B9, 0xD4D1,0xD7FA
    );
    private static $FirstLetter = "ABCDEFGHJKLMNOPQRSTWXYZ";
    //区位表第二部份,不规则的,下面的字母是每个区里面对应字的拼音首字母.从网上查询整理出来的,可能会有部份错误.
    //56区-87区
    private static $SecondTable = array(
	    "CJWGNSPGCGNEGYPBTYYZDXYKYGTZJNMJQMBSGZSCYJSYYFPGKBZGYDYWJKGKLJSWKPJQHYJWRDZLSYMRYPYWWCCKZNKYYG",
	    "TTNGJEYKKZYTCJNMCYLQLYPYSFQRPZSLWBTGKJFYXJWZLTBNCXJJJJTXDTTSQZYCDXXHGCKBPHFFSSTYBGMXLPBYLLBHLX",
	    "SMZMYJHSOJNGHDZQYKLGJHSGQZHXQGKXZZWYSCSCJXYEYXADZPMDSSMZJZQJYZCJJFWQJBDZBXGZNZCPWHWXHQKMWFBPBY",
	    "DTJZZKXHYLYGXFPTYJYYZPSZLFCHMQSHGMXXSXJYQDCSBBQBEFSJYHWWGZKPYLQBGLDLCDTNMAYDDKSSNGYCSGXLYZAYPN",
	    "PTSDKDYLHGYMYLCXPYCJNDQJWXQXFYYFJLEJPZRXCCQWQQSBZKYMGPLBMJRQCFLNYMYQMSQYRBCJTHZTQFRXQHXMQJCJLY",
	    "QGJMSHZKBSWYEMYLTXFSYDXWLYCJQXSJNQBSCTYHBFTDCYZDJWYGHQFRXWCKQKXEBPTLPXJZSRMEBWHJLBJSLYYSMDXLCL",
	    "QKXLHXJRZJMFQHXHWYWSBHTRXXGLHQHFNMGYKLDYXZPYLGGSMTCFBAJJZYLJTYANJGBJPLQGSZYQYAXBKYSECJSZNSLYZH",
	    "ZXLZCGHPXZHZNYTDSBCJKDLZAYFFYDLEBBGQYZKXGLDNDNYSKJSHDLYXBCGHXYPKDJMMZNGMMCLGWZSZXZJFZNMLZZTHCS",
	    "YDBDLLSCDDNLKJYKJSYCJLKWHQASDKNHCSGAGHDAASHTCPLCPQYBSZMPJLPCJOQLCDHJJYSPRCHNWJNLHLYYQYYWZPTCZG",
	    "WWMZFFJQQQQYXACLBHKDJXDGMMYDJXZLLSYGXGKJRYWZWYCLZMSSJZLDBYDCFCXYHLXCHYZJQSQQAGMNYXPFRKSSBJLYXY",
	    "SYGLNSCMHCWWMNZJJLXXHCHSYZSTTXRYCYXBYHCSMXJSZNPWGPXXTAYBGAJCXLYXDCCWZOCWKCCSBNHCPDYZNFCYYTYCKX",
	    "KYBSQKKYTQQXFCMCHCYKELZQBSQYJQCCLMTHSYWHMKTLKJLYCXWHEQQHTQKZPQSQSCFYMMDMGBWHWLGSLLYSDLMLXPTHMJ",
	    "HWLJZYHZJXKTXJLHXRSWLWZJCBXMHZQXSDZPSGFCSGLSXYMJSHXPJXWMYQKSMYPLRTHBXFTPMHYXLCHLHLZYLXGSSSSTCL",
	    "SLDCLRPBHZHXYYFHBMGDMYCNQQWLQHJJCYWJZYEJJDHPBLQXTQKWHLCHQXAGTLXLJXMSLJHTZKZJECXJCJNMFBYCSFYWYB",
	    "JZGNYSDZSQYRSLJPCLPWXSDWEJBJCBCNAYTWGMPAPCLYQPCLZXSBNMSGGFNZJJBZSFZYNTXHPLQKZCZWALSBCZJXSYZGWK",
	    "YPSGXFZFCDKHJGXTLQFSGDSLQWZKXTMHSBGZMJZRGLYJBPMLMSXLZJQQHZYJCZYDJWFMJKLDDPMJEGXYHYLXHLQYQHKYCW",
	    "CJMYYXNATJHYCCXZPCQLBZWWYTWBQCMLPMYRJCCCXFPZNZZLJPLXXYZTZLGDLTCKLYRZZGQTTJHHHJLJAXFGFJZSLCFDQZ",
	    "LCLGJDJZSNZLLJPJQDCCLCJXMYZFTSXGCGSBRZXJQQCTZHGYQTJQQLZXJYLYLBCYAMCSTYLPDJBYREGKLZYZHLYSZQLZNW",
	    "CZCLLWJQJJJKDGJZOLBBZPPGLGHTGZXYGHZMYCNQSYCYHBHGXKAMTXYXNBSKYZZGJZLQJTFCJXDYGJQJJPMGWGJJJPKQSB",
	    "GBMMCJSSCLPQPDXCDYYKYPCJDDYYGYWRHJRTGZNYQLDKLJSZZGZQZJGDYKSHPZMTLCPWNJYFYZDJCNMWESCYGLBTZZGMSS",
	    "LLYXYSXXBSJSBBSGGHFJLYPMZJNLYYWDQSHZXTYYWHMCYHYWDBXBTLMSYYYFSXJCBDXXLHJHFSSXZQHFZMZCZTQCXZXRTT",
	    "DJHNRYZQQMTQDMMGNYDXMJGDXCDYZBFFALLZTDLTFXMXQZDNGWQDBDCZJDXBZGSQQDDJCMBKZFFXMKDMDSYYSZCMLJDSYN",
	    "SPRSKMKMPCKLGTBQTFZSWTFGGLYPLLJZHGJJGYPZLTCSMCNBTJBQFKDHBYZGKPBBYMTDSSXTBNPDKLEYCJNYCDYKZTDHQH",
	    "SYZSCTARLLTKZLGECLLKJLQJAQNBDKKGHPJTZQKSECSHALQFMMGJNLYJBBTMLYZXDXJPLDLPCQDHZYCBZSCZBZMSLJFLKR",
	    "ZJSNFRGJHXPDHYJYBZGDLQCSEZGXLBLGYXTWMABCHECMWYJYZLLJJYHLGNDJLSLYGKDZPZXJYYZLWCXSZFGWYYDLYHCLJS",
	    "CMBJHBLYZLYCBLYDPDQYSXQZBYTDKYXJYYCNRJMPDJGKLCLJBCTBJDDBBLBLCZQRPYXJCJLZCSHLTOLJNMDDDLNGKATHQH",
	    "JHYKHEZNMSHRPHQQJCHGMFPRXHJGDYCHGHLYRZQLCYQJNZSQTKQJYMSZSWLCFQQQXYFGGYPTQWLMCRNFKKFSYYLQBMQAMM",
	    "MYXCTPSHCPTXXZZSMPHPSHMCLMLDQFYQXSZYJDJJZZHQPDSZGLSTJBCKBXYQZJSGPSXQZQZRQTBDKYXZKHHGFLBCSMDLDG",
	    "DZDBLZYYCXNNCSYBZBFGLZZXSWMSCCMQNJQSBDQSJTXXMBLTXZCLZSHZCXRQJGJYLXZFJPHYMZQQYDFQJJLZZNZJCDGZYG",
	    "CTXMZYSCTLKPHTXHTLBJXJLXSCDQXCBBTJFQZFSLTJBTKQBXXJJLJCHCZDBZJDCZJDCPRNPQCJPFCZLCLZXZDMXMPHJSGZ",
	    "GSZZQLYLWTJPFSYASMCJBTZYYCWMYTZSJJLJCQLWZMALBXYFBPNLSFHTGJWEJJXXGLLJSTGSHJQLZFKCGNNNSZFDEQFHBS",
	    "AQTGYLBXMMYGSZLDYDQMJJRGBJTKGDHGKBLQKBDMBYLXWCXYTTYBKMRTJZXQJBHLMHMJJZMQASLDCYXYQDLQCAFYWYXQHZ",
	    );
    function utf8_to_gbk($string)//编码转换,必须转换成GB2312字符,这里只是简单的判断并不是很准确,可以自己写一个.
    {
	if (mb_check_encoding($string,'gb2312'))
	    return $string;
	if (function_exists('iconv'))
	    return iconv("utf-8","gb2312//IGNORE",$string);
	return mb_convert_encoding($string,'gb2312','utf-8'); 
    }
    function conv($str)
    {
	$str = self::utf8_to_gbk($str);
	$len = strlen($str);
	$newStr = '';
	for($i=0; $i<$len ; ++$i)
	{
	    $H = ord($str[$i]);
	    $L = ord($str[$i+1]);
	    //字符集非法
	    if ($H < 0xB0 ||  $L < 0xA1 || $H > 0xF7 || $L == 0xFF)
	    {
		$newStr .= $str[$i];
		continue;
	    }
	    if ($H < 0xD8)//($H >= 0xB0 && $H <=0xD7)//查询文字在一级汉字区(16-55)
	    {
		$W = ($H << 8) | $L;
		foreach(self::$FirstTable as $key=>$value)
		{
		    if ($W < $value)
		    {
			$newStr .= self::$FirstLetter[$key];
			break;
		    }
		}
	    }
	    else// if (H >= 0xD8 && H <= 0xF7)//查询中文在二级汉字区(56-87)
		$newStr .=self::$SecondTable[$H - 0xD8][$L-0xA1];
	    ++$i;
	}
	return $newStr;
    }
}
echo zh2py::conv('Chinese 中华人民共和国');//Chinese ZHRMGHG
```
###[根据优酷视频id获取视频m3u8地址](https://github.com/ucaime/youku_m3u8)
###数组排序
```js
// firefox 和 chrome 是 [1024, 6, 5, 3, 2, 1]
// safari 中顺序没变
[1,3,2,5,6,1024].sort(function(a, b) {
    return b > a;
});
 
 
// 在各中浏览器工作一致的方法
// 用正负和零来排序，而不是 true/false
[1,3,2,5,6,1024].sort(function(a, b) {
    return b - a;
});

```
###数组去重
```js
function unique_keys(array) {
  var values = {};
  
  for(var i = 0; i < array.length; i++) {
    values[array[i]] = null;
  }
  
  return Object.keys(values);
}
 
function unique_reduce(array) {
  return array.reduce(function(ret, cur) {
    if(ret.indexOf(cur) === -1) ret.push(cur);
    return ret;
  }, []);
}
 
 
// test
var array = [1,2,3,4,5,6,23,1,4];
 
console.log(unique_keys(array), unique_reduce(array));
```
###多维数组转一维数组
```js
function rebuild_array($arr){  //rebuild a array  
  static $tmp=array();  
 
  for($i=0; $i<count($arr); $i++){  
    if(is_array($arr[$i])){  
        rebuild_array($arr[$i]);  
    }else{  
        $tmp[]=$arr[$i];  
    }  
  }  
 
  return $tmp;  
} 
 
$arr=array('123.html','456.html',array('dw.html','fl.html',array('ps.html','fw.html')),'ab.html');  
// 定义一个三维数组，用来检测我们的函数  
  
print_r(rebuild_array($arr));
```
###正则匹配
```js
preg_match_all("/\@[\x{4e00}-\x{9fa5}'a-z'A-Z'0-9'_'-]+/u", '@我的印象', $user_arr);
preg_match_all("/\@[\\u4e00-\\u9fa5'a-z'A-Z'0-9'_'-]+/u", '@我的印象', $user_arr);

print_r($user_arr);
```
