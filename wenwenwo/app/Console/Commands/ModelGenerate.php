<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Exception;

class ModelGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:generate {table_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate model';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        $tableName = $this->argument('table_name');
        $fields = DB::select('show full columns from '.$tableName);
        if(empty($fields)){
            throw new Exception('not found table:'.$tableName);
        }
        $className = implode('',array_map('ucfirst',explode('_',$tableName)));
        $classPath = app_path('Model').DIRECTORY_SEPARATOR.$className.'.php';
        if(file_exists($classPath)){
            throw new Exception('file exist:'.$classPath);
        }

        $template = <<<'TEMPLATE'
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class %s extends Model
{
    public $timestamps = false;

    protected $table = '%s';
    protected $fillable = [
        '%s'
    ];
    //
}
TEMPLATE;
        $content = sprintf($template,$className,$tableName,implode("','",array_column($fields,'Field')));
        file_put_contents($classPath,$content,LOCK_EX);
        echo "create model success:{$classPath}";
        return;
    }
}
