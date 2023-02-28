<?php

namespace App\Console\Commands;

use App\Models\Articulo;
use App\Models\Inventario;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class Procesador extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'procesar:inventario';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesa el inventario de MS Access a MySQL';

    public function configure()
    {
        $this->setName('procesar:inventario')
            ->setDescription('Procesa el inventario de MS Access a MySQL')
            ->addArgument('archivo', InputArgument::REQUIRED, 'Archivo csv del inventario.');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $arrayArticulos = [];
        $contador = [
            'db' => 0,
            'array' => 0 
        ];
        $file = fopen($this->argument('archivo'), 'r');
        while ($data = fgetcsv($file, 0, ';')) {
            $inventario = new Inventario();
            // echo implode('-.-',$data) . "\n";
            $descripcion = $data[3];
            $articulo = null;
            if (isset($arrayArticulos[$descripcion])) {
                $contador['array']++;
                $articulo = $arrayArticulos[$descripcion];
            } else {
                $contador['db']++;
                $db = Articulo::select('*')->whereRaw('descripcion = "' . $descripcion . '"')->get();
                if(isset($db[0])){
                    $db = $db[0];
                    if (!in_array($db['id'], $arrayArticulos))
                        $arrayArticulos[$db['descripcion']] = $db['id'];
                }else{
                    echo $descripcion ." no esta en la db \n";
                }
                // print_r($db[0]);
            }
        }
        print_r($arrayArticulos);
        print_r($contador);

        return Command::SUCCESS;
    }
}
