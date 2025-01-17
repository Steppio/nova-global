<?php
 
class Nova_Global_Loader {
 
    protected $actions;
 
    protected $filters;
 
    public function __construct() {
 
        $this->actions = array();
        $this->filters = array();      

    }
 
    public function add_action( $hook, $component, $callback ) {
        $this->actions = $this->add( $this->actions, $hook, $component, $callback );
    }
 
    public function add_filter( $hook, $component, $callback ) {
        $this->filters = $this->add( $this->filters, $hook, $component, $callback );
    }

    private function add( $hooks, $hook, $component, $callback ) {
 
        $hooks[] = array(
            'hook'      => $hook,
            'component' => $component,
            'callback'  => $callback
        );
 
        return $hooks;
 
    }
 
    public function run() {

    }
 
}