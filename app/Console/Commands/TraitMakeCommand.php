<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class TraitMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';
    protected $type = 'Trait';
    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'Create a new trait';
     protected $files;
     public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the name argument from the command
        $name = $this->argument('name');

        // Convert the name to a studly-case class name
        $className = Str::studly($name);

        // Define the path where the trait should be created
        $path = app_path("Traits/{$className}.php");

        // Check if the file already exists
        if ($this->files->exists($path)) {
            $this->error("{$this->type} already exists!");

            return false;
        }

        // Create the directory if it does not exist
        $this->makeDirectory($path);

        // Write the trait class content to the file
        $this->files->put($path, $this->buildClass($className));

        // Output a success message
        $this->info("{$this->type} created successfully.");
    }
    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }
    }
    protected function buildClass($name)
    {
        // Define the structure of the trait dynamically
        return <<<EOT
    <?php

    namespace App\Traits;

    trait {$name}
    {
        /**
         * A sample dynamic method.
         */
        public function dynamicMethod()
        {
            // Dynamic method content
        }
    }
    EOT;
    }


}
