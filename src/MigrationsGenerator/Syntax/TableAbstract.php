<?php namespace Tyondo\Migratory\MigrationsGenerator\Syntax;

use Tyondo\Migratory\MigrationsGenerator\Compilers\TemplateCompiler;
use Tyondo\Migratory\MigrationsGenerator\Filesystem\Filesystem;


abstract class TableAbstract {

    protected $file;


    protected $compiler;


    function __construct(Filesystem $file, TemplateCompiler $compiler)
    {
        $this->compiler = $compiler;
        $this->file = $file;
    }

    /**
     * Fetch the template of the schema
     *
     * @return string
     */
    protected function getTemplate()
    {
        return $this->file->get(__DIR__.'/../../Stubs/schema.txt');
    }


    /**
     * Replace $FIELDS$ in the given template
     * with the provided schema
     *
     * @param $schema
     * @param $template
     * @return mixed
     */
    protected function replaceFieldsWith($schema, $template)
    {
        return str_replace('$FIELDS$', implode(PHP_EOL."\t\t\t", $schema), $template);
    }

}
