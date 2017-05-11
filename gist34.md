
[FRP内网穿透工具](https://www.diannaobos.com/frp/)
[laravel 在线数据库字典导出](http://github.com/jormin/laravel-ddoc)

```js
namespace Jormin\DDoc\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class DDocController extends Controller
{

    /**
     * 读取数据库信息
     */
    private function initTablesData()
    {
        //获取数据库表名称列表
        $tables = DB::select('SHOW TABLE STATUS ');
        foreach ($tables as $key => $table) {
            //获取改表的所有字段信息
            $columns = DB::select("SHOW FULL FIELDS FROM ".$table->Name);
            $table->columns = $columns;
            $tables[$key] = $table;
        }
        return $tables;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->initTablesData();
        return view('ddoc::index',compact('tables'));
    }

    /**
     * 导出文档
     *
     * @param $type
     */
    public function export($type)
    {
        if(!in_array($type,array('html','pdf'))){
            return null;
        }
        $tables = $this->initTablesData();
        $filename = config('app.name').'数据字典';
        switch($type){
            case 'html':
                $zippath = __DIR__.'/'.$filename.'.zip';
                $zip = new \ZipArchive;
                $res = $zip->open($zippath, \ZipArchive::CREATE);
                if ($res === TRUE) {
                    // 添加静态资源文件
                    $this->addFileToZip('vendor/laravel-ddoc',$zip);
                    // 生成Html文件
                    require_once (__DIR__.'/../Lib/simple_html_dom.php');
                    $obj = View::make('ddoc::index', compact('tables'),array())->render();
                    $protocol = 'http://';
                    if(Request::secure()){
                        $protocol = 'https://';
                    }
                    $obj = str_replace($protocol.$_SERVER['HTTP_HOST'].'/vendor/laravel-ddoc','.',$obj);
                    $html = new \simple_html_dom();
                    $html->load($obj);
                    $html->find('div[class=export-wrap]',0)->outertext = '';
                    $zip->addFromString($filename.'.html', $html);
                    $zip->close();
                } else {
                    return null;
                }

                $response =  new Response(file_get_contents($zippath), 200, array(
                    'Content-Type' => 'application/zip',
                    'Content-Disposition' =>  'attachment; filename="'.$filename.'.zip"'
                ));
                unlink($zippath);
                return $response;
                break;
            case 'pdf':
                $filename .= '.pdf';
                $pdf = SnappyPdf::loadView('ddoc::index', compact('tables'));
                return $pdf->download($filename);
                break;
        }
    }

    /**
     * 添加文件夹
     *
     * @param $path
     * @param $zip
     */
    private function addFileToZip($path, $zip) {
        $handler = opendir(public_path($path));
        while (($filename = readdir($handler)) !== false) {
            if (!in_array($filename,array('.','..','.DS_Store'))) {
                if (is_dir($path . "/" . $filename)) {
                    $this->addFileToZip($path . "/" . $filename, $zip);
                } else { //将文件加入zip对象
                    $fullname = public_path($path) . "/" . $filename;
                    $localname = str_replace('vendor/laravel-ddoc/','','/'.$path.'/'.$filename);
                    $zip->addFile($fullname,$localname);
                }
            }
        }
        @closedir($path);
    }
}
```

