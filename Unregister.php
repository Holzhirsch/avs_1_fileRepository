<?php

/**
 * @author era
 * 
 * Description of Unregister:
 * Class to unregister a machine or all machines if the given machine_name is null.
 * @param String $file_name the name of the file, where machine and ip are stored
 * @param String $machine_name the machine_name
 */
class Unregister {

    protected $response = "";

    public function __construct($file_name, $machine_name) {
        $this->unregisterMachine($file_name, $machine_name);
    }

    /**
     * Unregisters a machine with a given name in the given file or
     * unregister all machines if given name is null.
     * @param string $file_name
     * @param string $machine_name
     */
    protected function unregisterMachine($file_name, $machine_name) {
        $file_handler = new FileHandler($file_name);
        if (!file_exists($file_name)) {
            $this->response .= "Machine was not registered.";
        } elseif ($machine_name === null) {
            unlink($file_name);
            $this->response .= "All machines were unregistered.";
        } elseif ($file_handler->nameInFile($machine_name)) {
            $file_handler->removeEntryFromFile($machine_name);
            $this->response .= "Machine was unregistered.";
        } else {
            $this->response .= "Machine was not registered.";
        }
    }

    public function __toString() {
        return $this->response;
    }

}
