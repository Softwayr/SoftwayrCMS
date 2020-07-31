<?php
namespace Softwayr;

class Route
{
    private $name, $path, $page;
    
    public function __construct( String $name, String $path, Page $page )
    {
    	$this->name = $name;
        $this->path = $path;
        $this->page = $page;
    }
    
    public function name(): String {
        return $this->name;
    }
    
    public function path(): String {
        return $this->path;
    }
    
    public function page(): Page {
        return $this->page;
    }
}

