<?php

/**
 * @author era
 * 
 * Description of Query:
 * Class to query for registered machines plus ips.
 * @param String $file_name the name of the file, where machine and ip are stored
 */
class Query {

    protected $response = "";

    public function __construct($file_name) {
        $this->queryForMachines($file_name);
    }
    
    /**
     * Gets all registered machines in given file.
     * @param string $file_name
     */
    protected function queryForMachines($file_name) {
        $file_handler = new FileHandler($file_name);
        if (!file_exists($file_name)) {
            $this->response .= "No registered machines";
        } else {
            $this->response .= $file_handler->getRegisteredMachines();
        }
    }

    public function __toString() {
        return $this->response;
    }

}
