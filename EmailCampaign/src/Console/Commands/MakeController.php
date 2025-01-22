<?php

namespace EmailCampaign\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeController extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailcampaign:make-controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller for the email campaign package';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../../stubs/controller.stub';
    }
    

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }
}
