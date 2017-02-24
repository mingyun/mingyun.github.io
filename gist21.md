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

/**
 * PHP 汉字转拼音
 * @author Jerryli(hzjerry@gmail.com)
 * @updated by Specs(http://9iphp.com/web/php/chinese-to-pinyin-php-method.html)
 * @example
 *  echo Chinese_to_PY::getPY('这是一段测试文字， This is a string'), '<br/>'; //结果为拼音首字母
 *  echo Chinese_to_PY::getPY('这是一段测试文字， This is a string', 'all'), '<br/>'; //结果为全拼音
 *  echo Chinese_to_PY::getPY('这是一段测试文字， This is a string', 'one'), '<br/>'; //结果为第一个拼音
 */
class Chinese_to_PY {
    /**
     * 拼音字符转换图
     * @var array
     */
    private static $_aMaps = array(
        'a'=>-20319,'ai'=>-20317,'an'=>-20304,'ang'=>-20295,'ao'=>-20292,
        'ba'=>-20283,'bai'=>-20265,'ban'=>-20257,'bang'=>-20242,'bao'=>-20230,'bei'=>-20051,'ben'=>-20036,'beng'=>-20032,'bi'=>-20026,'bian'=>-20002,'biao'=>-19990,'bie'=>-19986,'bin'=>-19982,'bing'=>-19976,'bo'=>-19805,'bu'=>-19784,
        'ca'=>-19775,'cai'=>-19774,'can'=>-19763,'cang'=>-19756,'cao'=>-19751,'ce'=>-19746,'ceng'=>-19741,'cha'=>-19739,'chai'=>-19728,'chan'=>-19725,'chang'=>-19715,'chao'=>-19540,'che'=>-19531,'chen'=>-19525,'cheng'=>-19515,'chi'=>-19500,'chong'=>-19484,'chou'=>-19479,'chu'=>-19467,'chuai'=>-19289,'chuan'=>-19288,'chuang'=>-19281,'chui'=>-19275,'chun'=>-19270,'chuo'=>-19263,'ci'=>-19261,'cong'=>-19249,'cou'=>-19243,'cu'=>-19242,'cuan'=>-19238,'cui'=>-19235,'cun'=>-19227,'cuo'=>-19224,
        'da'=>-19218,'dai'=>-19212,'dan'=>-19038,'dang'=>-19023,'dao'=>-19018,'de'=>-19006,'deng'=>-19003,'di'=>-18996,'dian'=>-18977,'diao'=>-18961,'die'=>-18952,'ding'=>-18783,'diu'=>-18774,'dong'=>-18773,'dou'=>-18763,'du'=>-18756,'duan'=>-18741,'dui'=>-18735,'dun'=>-18731,'duo'=>-18722,
        'e'=>-18710,'en'=>-18697,'er'=>-18696,
        'fa'=>-18526,'fan'=>-18518,'fang'=>-18501,'fei'=>-18490,'fen'=>-18478,'feng'=>-18463,'fo'=>-18448,'fou'=>-18447,'fu'=>-18446,
        'ga'=>-18239,'gai'=>-18237,'gan'=>-18231,'gang'=>-18220,'gao'=>-18211,'ge'=>-18201,'gei'=>-18184,'gen'=>-18183,'geng'=>-18181,'gong'=>-18012,'gou'=>-17997,'gu'=>-17988,'gua'=>-17970,'guai'=>-17964,'guan'=>-17961,'guang'=>-17950,'gui'=>-17947,'gun'=>-17931,'guo'=>-17928,
        'ha'=>-17922,'hai'=>-17759,'han'=>-17752,'hang'=>-17733,'hao'=>-17730,'he'=>-17721,'hei'=>-17703,'hen'=>-17701,'heng'=>-17697,'hong'=>-17692,'hou'=>-17683,'hu'=>-17676,'hua'=>-17496,'huai'=>-17487,'huan'=>-17482,'huang'=>-17468,'hui'=>-17454,'hun'=>-17433,'huo'=>-17427,
        'ji'=>-17417,'jia'=>-17202,'jian'=>-17185,'jiang'=>-16983,'jiao'=>-16970,'jie'=>-16942,'jin'=>-16915,'jing'=>-16733,'jiong'=>-16708,'jiu'=>-16706,'ju'=>-16689,'juan'=>-16664,'jue'=>-16657,'jun'=>-16647,
        'ka'=>-16474,'kai'=>-16470,'kan'=>-16465,'kang'=>-16459,'kao'=>-16452,'ke'=>-16448,'ken'=>-16433,'keng'=>-16429,'kong'=>-16427,'kou'=>-16423,'ku'=>-16419,'kua'=>-16412,'kuai'=>-16407,'kuan'=>-16403,'kuang'=>-16401,'kui'=>-16393,'kun'=>-16220,'kuo'=>-16216,
        'la'=>-16212,'lai'=>-16205,'lan'=>-16202,'lang'=>-16187,'lao'=>-16180,'le'=>-16171,'lei'=>-16169,'leng'=>-16158,'li'=>-16155,'lia'=>-15959,'lian'=>-15958,'liang'=>-15944,'liao'=>-15933,'lie'=>-15920,'lin'=>-15915,'ling'=>-15903,'liu'=>-15889,'long'=>-15878,'lou'=>-15707,'lu'=>-15701,'lv'=>-15681,'luan'=>-15667,'lue'=>-15661,'lun'=>-15659,'luo'=>-15652,
        'ma'=>-15640,'mai'=>-15631,'man'=>-15625,'mang'=>-15454,'mao'=>-15448,'me'=>-15436,'mei'=>-15435,'men'=>-15419,'meng'=>-15416,'mi'=>-15408,'mian'=>-15394,'miao'=>-15385,'mie'=>-15377,'min'=>-15375,'ming'=>-15369,'miu'=>-15363,'mo'=>-15362,'mou'=>-15183,'mu'=>-15180,
        'na'=>-15165,'nai'=>-15158,'nan'=>-15153,'nang'=>-15150,'nao'=>-15149,'ne'=>-15144,'nei'=>-15143,'nen'=>-15141,'neng'=>-15140,'ni'=>-15139,'nian'=>-15128,'niang'=>-15121,'niao'=>-15119,'nie'=>-15117,'nin'=>-15110,'ning'=>-15109,'niu'=>-14941,'nong'=>-14937,'nu'=>-14933,'nv'=>-14930,'nuan'=>-14929,'nue'=>-14928,'nuo'=>-14926,
        'o'=>-14922,'ou'=>-14921,
        'pa'=>-14914,'pai'=>-14908,'pan'=>-14902,'pang'=>-14894,'pao'=>-14889,'pei'=>-14882,'pen'=>-14873,'peng'=>-14871,'pi'=>-14857,'pian'=>-14678,'piao'=>-14674,'pie'=>-14670,'pin'=>-14668,'ping'=>-14663,'po'=>-14654,'pu'=>-14645,
        'qi'=>-14630,'qia'=>-14594,'qian'=>-14429,'qiang'=>-14407,'qiao'=>-14399,'qie'=>-14384,'qin'=>-14379,'qing'=>-14368,'qiong'=>-14355,'qiu'=>-14353,'qu'=>-14345,'quan'=>-14170,'que'=>-14159,'qun'=>-14151,
        'ran'=>-14149,'rang'=>-14145,'rao'=>-14140,'re'=>-14137,'ren'=>-14135,'reng'=>-14125,'ri'=>-14123,'rong'=>-14122,'rou'=>-14112,'ru'=>-14109,'ruan'=>-14099,'rui'=>-14097,'run'=>-14094,'ruo'=>-14092,
        'sa'=>-14090,'sai'=>-14087,'san'=>-14083,'sang'=>-13917,'sao'=>-13914,'se'=>-13910,'sen'=>-13907,'seng'=>-13906,'sha'=>-13905,'shai'=>-13896,'shan'=>-13894,'shang'=>-13878,'shao'=>-13870,'she'=>-13859,'shen'=>-13847,'sheng'=>-13831,'shi'=>-13658,'shou'=>-13611,'shu'=>-13601,'shua'=>-13406,'shuai'=>-13404,'shuan'=>-13400,'shuang'=>-13398,'shui'=>-13395,'shun'=>-13391,'shuo'=>-13387,'si'=>-13383,'song'=>-13367,'sou'=>-13359,'su'=>-13356,'suan'=>-13343,'sui'=>-13340,'sun'=>-13329,'suo'=>-13326,
        'ta'=>-13318,'tai'=>-13147,'tan'=>-13138,'tang'=>-13120,'tao'=>-13107,'te'=>-13096,'teng'=>-13095,'ti'=>-13091,'tian'=>-13076,'tiao'=>-13068,'tie'=>-13063,'ting'=>-13060,'tong'=>-12888,'tou'=>-12875,'tu'=>-12871,'tuan'=>-12860,'tui'=>-12858,'tun'=>-12852,'tuo'=>-12849,
        'wa'=>-12838,'wai'=>-12831,'wan'=>-12829,'wang'=>-12812,'wei'=>-12802,'wen'=>-12607,'weng'=>-12597,'wo'=>-12594,'wu'=>-12585,
        'xi'=>-12556,'xia'=>-12359,'xian'=>-12346,'xiang'=>-12320,'xiao'=>-12300,'xie'=>-12120,'xin'=>-12099,'xing'=>-12089,'xiong'=>-12074,'xiu'=>-12067,'xu'=>-12058,'xuan'=>-12039,'xue'=>-11867,'xun'=>-11861,
        'ya'=>-11847,'yan'=>-11831,'yang'=>-11798,'yao'=>-11781,'ye'=>-11604,'yi'=>-11589,'yin'=>-11536,'ying'=>-11358,'yo'=>-11340,'yong'=>-11339,'you'=>-11324,'yu'=>-11303,'yuan'=>-11097,'yue'=>-11077,'yun'=>-11067,
        'za'=>-11055,'zai'=>-11052,'zan'=>-11045,'zang'=>-11041,'zao'=>-11038,'ze'=>-11024,'zei'=>-11020,'zen'=>-11019,'zeng'=>-11018,'zha'=>-11014,'zhai'=>-10838,'zhan'=>-10832,'zhang'=>-10815,'zhao'=>-10800,'zhe'=>-10790,'zhen'=>-10780,'zheng'=>-10764,'zhi'=>-10587,'zhong'=>-10544,'zhou'=>-10533,'zhu'=>-10519,'zhua'=>-10331,'zhuai'=>-10329,'zhuan'=>-10328,'zhuang'=>-10322,'zhui'=>-10315,'zhun'=>-10309,'zhuo'=>-10307,'zi'=>-10296,'zong'=>-10281,'zou'=>-10274,'zu'=>-10270,'zuan'=>-10262,'zui'=>-10260,'zun'=>-10256,'zuo'=>-10254
    );
 
    /**
     * 将中文编码成拼音
     * @param string $chinese 要转换为拼音的字符串
     * @param string $sRetFormat 返回格式 [first:每个字的首字母|all:全拼音|one:字符串字母]
     * @return string
     */
    public static function getPY($chinese, $sRetFormat='first'){
        $sGBK = iconv('UTF-8', 'GBK', $chinese);
        $sUTF8 = iconv('GBK', 'UTF-8', $sGBK);
        if($sUTF8 != $chinese) $sGBK = $chinese;
        $aBuf = array();
        for ($i=0, $iLoop=strlen($sGBK); $i<$iLoop; $i++) {
            $iChr = ord($sGBK{$i});
            if ($iChr>160)
                $iChr = ($iChr<<8) + ord($sGBK{++$i}) - 65536;
            if ('first' == $sRetFormat || 'one' == $sRetFormat)
                $aBuf[] = substr(self::zh2py($iChr),0,1);
            else
                $aBuf[] = self::zh2py($iChr);
 
        }
        if ('first' === $sRetFormat)
            return implode('', $aBuf);
        elseif('one' == $sRetFormat)
            return $aBuf[0];
        else
            return implode(' ', $aBuf);
    }
 
    /**
     * 中文转换到拼音(每次处理一个字符)
     * @param number $iWORD 待处理字符双字节
     * @return string 拼音
     */
    private static function zh2py($iWORD) {
        if($iWORD>0 && $iWORD<160 ) {
            return chr($iWORD);
        } elseif ($iWORD<-20319||$iWORD>-10247) {
            return '';
        } else {
            foreach (self::$_aMaps as $py => $code) {
                if($code > $iWORD) break;
                $result = $py;
            }
            return $result;
        }
    }
}
echo Chinese_to_PY::getPY('这是一段测试文字， This is a string'), '<br/>'; //结果为拼音首字母
echo Chinese_to_PY::getPY('这是一段测试文字， This is a string', 'all'), '<br/>'; //结果为全拼音
echo Chinese_to_PY::getPY('这是一段测试文字， This is a string', 'one'), '<br/>'; //结果为第一个拼音
/* Output:
zsydcswz This is a string
zhe shi yi duan ce shi wen zi T h i s i s a s t r i n g
z
*/
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
###python导出excel
```js
#coding=utf-8
import tablib
import sys
reload(sys)
sys.setdefaultencoding('utf-8')
# http://www.tantengvip.com/2015/05/python-tablib-excel/  http://blog.csdn.net/hugleecool/article/details/17996993
headers = ('第一列', '第2列', '第3列', '第4列', '第5列')
mylist = [('混合','23','34','23','34'),('呵呵','23','sdf','23','fsad')]
mylist = tablib.Dataset(*mylist, headers=headers)

with open('excelzh.xlsx', 'wb') as f:
	# print mylist.xlsx
    f.write(mylist.xlsx)
    
# -*- encoding: utf-8 -*-
#-------------------------------------------------------------------------------
# Purpose:     txt转换成Excelhttp://www.cnblogs.com/zhoujinyi/archive/2013/05/07/3064785.html
# Author:      zhoujy
# Created:     2013-05-07
# update:      2013-05-07
#-------------------------------------------------------------------------------
import datetime
import time
import os
import sys
import xlwt #需要的模块
#python t2e.py /home/zhoujy/outfile/out.txt  ABC
def txt2xls(filename,xlsname):  #文本转换成xls的函数，filename 表示一个要被转换的txt文本，xlsname 表示转换后的文件名
    print 'converting xls ... '
    f = open(filename)   #打开txt文本进行读取
    x = 0                #在excel开始写的位置（y）
    y = 0                #在excel开始写的位置（x）
    xls=xlwt.Workbook()
    sheet = xls.add_sheet('sheet1',cell_overwrite_ok=True) #生成excel的方法，声明excel
    while True:  #循环，读取文本里面的所有内容
        line = f.readline() #一行一行读取
        if not line:  #如果没有内容，则退出循环
            break
        for i in line.split('\t'):#读取出相应的内容写到x
            item=i.strip().decode('utf8')
            sheet.write(x,y,item)
            y += 1 #另起一列
        x += 1 #另起一行
        y = 0  #初始成第一列
    f.close()
    xls.save(xlsname+'.xls') #保存

if __name__ == "__main__":
    filename = sys.argv[1]
    xlsname  = sys.argv[2]
    txt2xls(filename,xlsname)
```
###sh 调用
```js
#!/bin/sh
for i in {1..1000}
do
   curl -X POST -v -d 'programid=367' http://m.kaolafm.com/meizuapi/act/program/like?_=1444888956034
done
```
###拼接sql
```js
$array = array(
      "name" => "John",
      "surname" => "Doe",
      "email" => "j.doe@intelligence.gov"
   );

   // build query...
   $sql  = "INSERT INTO table";

   // implode keys of $array...
   $sql .= " (`".implode("`, `", array_keys($array))."`)";

   // implode values of $array...
  // echo $sql .= " VALUES ('".implode("', '", $array)."') ";
  echo $sql .= " VALUES ('".implode("', '", $array)."') ";
  INSERT INTO table (`name`, `surname`, `email`) VALUES ('John', 'Doe', 'j.doe@intelligence.gov')
  
  $num = array(1,200,4,5);
echo $ids = implode('","', $num);
echo $sql = 'select id from test where user_id in ("'.$ids.'") ';//where user_id in ("1","200","4","5")
```
###json_decode无法识别十六进制的ASCII字
```js
$response = '{"retcode":"0","retmsg":"OK","cre_id_enc":"","cre_type":"","fee_type":"1","listid":"1221085301201410240000001024","out_trade_no":"201410246763831","partner":"1221085301","pay_fee":"0","sign":"PTamau\x2BjkynA00cASKJ6Nd3QwFSBP44TKSqmmdCd\x2F\x2B0o8ViSt3fp5vQr0Fc73U42NhtImfnHzbynoUjURiNLW5O4hI61xkG\x2F97JRPRE0nHuvtAumqXfbVCsLveugE52HRZsJvm3EG7pL6GlhYf8ng6qxiUrDyn89PFVZ04Wd8Gk\x3D","total_fee":"1000000","unfreeze_fee":"1000000","user_name_enc":""}';
//json中包含十六进制的ASCII字符，所以json_decode无法识别，返回NULL。http://www.yunxiu.org/wenda/39/json_decode-%E8%BF%94%E5%9B%9Enull%E6%80%8E%E4%B9%88%E8%A7%A3%E5%86%B3%EF%BC%9F
print_r( json_decode($response,true));//null
$response = iconv('ASCII', 'UTF-8//IGNORE', $response);
$response = str_ireplace( '\x', '\\\\x', $response );
print_r( json_decode($response,true));
```
###call_user_func
```js
function foobar($arg, $arg2) {
    echo __FUNCTION__, " got $arg and $arg2\n";
}
class foo {
    function bar($arg, $arg2) {
        echo __METHOD__, " got $arg and $arg2\n";
    }
}
// Call the foobar() function with 2 arguments
call_user_func_array("foobar", array("one", "two"));
// Call the $foo->bar() method with 2 arguments
$foo = new foo;
call_user_func_array(array($foo, "bar"), array("three", "four"));
```
###unicode转中文
```js
function unicode2utf8_2($str){	//关于unicode编码转化的第二个函数，用于显示emoji表情
        $str = '{"result_str":"'.$str.'"}';	//组合成json格式
	$strarray = json_decode($str,true);	//json转换为数组，利用 JSON 对 \uXXXX 的支持来把转义符恢复为 Unicode 字符（by 梁海）
	return $strarray['result_str'];
    }
 
echo unicode2utf8_2("\u4E2D");//中
```
###ip2long负数
```js
// 在32位的机子上，echo ip2long('192.168.1.38');由于超过32位的最大数，导致输出负数-1062731482。有两种方法更新为正数
// 一种方法是是修改PHP程序，使存入数据库的肯定存入正数
echo $ip_long = bindec(decbin(ip2long('192.168.1.38')));
echo $ip_long  = sprintf("%u", ip2long('192.168.1.38'));
// 另一种是将mysql的这个字段使用int，非UNSIGNED，使其可以存入负数。  
/*mysql存储这个值是字段需要用int UNSIGNED。不用UNSIGNED的话，128以上的IP段就存储不了了。传统的方法，创建varchar(15)，需要占用15个字节，而改时使用int只需要4字节，可以省一些字节。
http://gblog.hbcf.net/index.php/archives/739
php存入时：$ip = ip2long($ip);   
php取出时:$ip = long2ip($ip);   
mysql取出时：SELECT INET_ATON(ip) FROM table ... */
function chk_ip($ip){ 
   if(ip2long($ip)=="-1" ||  ip2long($ip)  ===  FALSE ) { 
      return false; 
   } 
   return true; 
} 
var_export(chk_ip("10.111.149.42")); //true
var_export(chk_ip("10.111.256.42")); //false
```
###浮点数显示
```js
$f = 12132435556776658;
echo $f; echo '<br>';
printf('%.0f',$f);echo '<br>';
echo number_format($f,0,'','');
echo '<br>';
```
###[MySQL在order by的字段值相同的情况下排序的依据](https://iwww.me/647.html)
遇到了一个MySQL的比较奇怪的现象，两个查询语句，其中一个where比另外一个多了一个条件，筛掉一个结果，但是其他的查询结果顺序全乱了，说起来不太容易听懂，直接看sql和结果：

![img](http://iwww.me/uploads/thumbs/20170217/11762542609409365_720x350.png)
这个基本无解，因为排序条件就不确定，同样的sql，如果排序条件不确定可能在不同的MySQL版本、服务器环境、配置都会返回不同的结果，只有一个办法，就是让排序一定要明确，比如在order by最后添加id desc。

参考链接：http://stackoverflow.com/questions/6662837/how-mysql-order-the-rows-with-same-values
###[系统时间不正确导致composer update失败](https://iwww.me/646.html)

SSL operation failed with code 1. OpenSSL Error messages: 
error:14090086:SSL routines:SSL3_GET_SERVER_CERTIFICATE:certificate verify failed
看描述是SSL错误，但是检查了一下，本地的OpenSSL是没问题的，弄了半天，突然想起前两天系统时间有点不对，然后date查看了一下时间，竟然慢了7天左右，估计是因为系统时间导致SSL证书认证失败，然后设置时间，时区设置正确之后还是不行，相差7天，弄了半天，重启了Docker，好了，再次更新，成功
###[Nginx遇到的一个坑](https://iwww.me/640.html)

location /jijin {
    return 404;
}
http://domain.com/jijinx/jijin/2016-08/9342772.html
/jijinx匹配到了/jijin，所以返回了404，要写成/jijin/才行。
###[Python正则表达式匹配.*遇到换行符](https://iwww.me/639.html)
import urllib
import re
import json

url = 'http://news.163.com/special/00014RJU/nationalnews-json-data.js'
result = urllib.urlopen(url).read().strip()
pattern = re.compile(r';var newsList=(.*)')
matchs = pattern.match(result)
print(matchs.group())

pattern = re.compile(r';var newsList=([\s\S]*)')
使用zRangeByScore作定时发布
最近工作上有个需求，需要在文章发布的时候做一些动作，正常发布没有什么问题，但是定时发布的时候无法监控动作，后来想到了一个解决方案，使用Redis的有序集合，score设置为时间戳，每隔一段时间定时取出Redis中小于等于当前时间戳的值，然后zRemove。
###[一道算法题，取出数组中出现次数为奇数的元素](https://iwww.me/551.html)
```js
result = []
for x in L:
    tmp_sum = 0
    for y in L:
        if x == y:
            tmp_sum += 1
    if tmp_sum % 2 == 1 and x not in result:
        result.append(x)
	
	tmp = {}
for x in L:
    if x in tmp:
        del tmp[x]
    else:
        tmp[x] = 1
	
	第一种时间复杂度是O(n2），第二种是O(n)
```
###[PHP header下载文件中文名乱码](https://iwww.me/315.html)
header("Content-Type: application/x-bittorrent");
header("Content-Disposition: attachment; filename=" . "$torrentnameprefix." . rawurlencode($row["save_as"] .".torrent") . ";filename*=". "$torrentnameprefix." . rawurlencode($row["save_as"] .".torrent"));
print(benc($dict));
###[MySQL Restart&Start Failed : The server quit without updating PID file](https://iwww.me/242.html)
#ps aux | grep mysql
#kill -9 2987
#service mysql restart
#mv /etc/my.cnf /etc/my.cnf 
#mv /etc/mysql/my.cnf /etc/mysql/my.cnf.bak                       //如果存在这个文件
#service mysql restart
###[Linux下sendmail启动及发送邮件很慢的问题&解决](https://iwww.me/74.html)
```js
原来sendmail只认网络主机名，还要在主机名后面加上.localdomain（或者直接写成网站域名）,下面放出我使用的服务器的配置文件 /etc/hosts 1
 
 
127.0.0.1 localhost www.uulm.net
::1         localhost localhost.localdomain localhost6 localhost6.localdomain6 www.uulm.net
10.90.22.100 www.uulm.net
/etc/sysconfig/network 1
 
NETWORKING=yes
HOSTNAME=uulm.net
NETWORKING_IPV6=no
PEERNTP=no
GATEWAY=58.96.171.247
然后重启sendmail服务，很快启动了，测试一下
mail -s title email@domain < mail.txt
```
###[Jquery.post回调函数不执行原因&解决](https://iwww.me/67.html)
```js
$.post(handle_url,{username:username.val(),content:content.val()},function(data){
	alert(data);
},'json');
$.ajax({url:handle_url,type:"POST",data:{name:"shit"},dataType:"html",timeout:1000,
	error:function(XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest.status);
        alert(XMLHttpRequest.readyState);
        alert(textStatus);},
	success:function(data){
	alert(data);
	}
});

JS弹出框的错误信息分别是200、4、parseerror，前两个状态正常，最后一个说明是语法错误，看了一下服务端的php页面，php页面返回的是html，但是$.post接收的却是json格式，所以，将之改为html或者为空（智能判断）即可。$.ajax和$.post功能基本一致，$.ajax可以执行，$.post也不会有问题。Jquery.post回调函数不执行的原因可能不止这一种
```
###[Nginx因日志问题无法启动](https://iwww.me/113.html)
```js
#vim /usr/local/nginx/logs/error.log
2014/09/01 11:50:43 [emerg] 1630#0: duplicate "log_format" name "ad.xuulm.com" in /usr/local/nginx/conf/vhost/default.conf:3
大概意思就是日志文件重复，根据提示， 1
#vim /usr/local/nginx/conf/vhost/default.conf
因为ad.xuulm.com.conf已经配置,所以讲之替换为default，保存之后重新启动Nginx，发现还是有问题，重新打开日志查看错误信息： 1
unknown log format "tz.xuulm.com" in /usr/local/nginx/conf/vhost/default.conf:30
查看了一下虚拟主机，没有发现tz.xuulm.com，于是打开配置文件 1
#vim /usr/local/nginx/conf/vhost/default.conf
```
###[PHP一个函数BUG——strtotime()](https://iwww.me/313.html)
```
if (get_user_class() < $commanage_class) {
			if (strtotime($CURUSER['last_comment']) > (TIMENOW - 10))
			{
				$secs = 10 - (TIMENOW - strtotime($CURUSER['last_comment']));
				stderr($lang_comment['std_error'],$lang_comment['std_comment_flooding_denied']."$secs".$lang_comment['std_before_posting_another']);
			}
		}
		
		这个函数计算时间的时候是按每个月30天算的，这个月是12月，有31天，所以就出现了问题
```
###[Python变量的赋值、引用传递、值传递](https://iwww.me/500.html)
```js
>>> a = {'name': 'killer', 'age':24}
>>> b = a
>>> del a['name']
>>> b
>>> {'age': 24}
a = 1
print(id(a))
b = a
print(id(b))
a = 2
print(id(a))
print(id(b))

>>> import copy
>>> a = {'name': 'killer', 'age':24}
>>> b = copy.copy(a)
>>> del a['name']
>>> b
>>> {'name': 'killer', 'age':24}
```
###[MySql启动出现The server quit without updating PID file错误解决过程](https://iwww.me/240.html)
