<?php

/**
 * @author era
 * 
 * Description of Register:
 * Class to register a machine.
 * @param String $file_name the name of the file, where machine and ip are stored
 * @param String $machine_name the machine_name
 * @param String $ip the ip adress of the machine
 */
class Register {

    protected $response = "";

    public function __construct($file_name, $machine_name, $ip) {
        $this->registerMachine($file_name, $machine_name, $ip);
    }

    /**
     * Registers a machine with given name and ip in given file.
     * @param string $file_name
     * @param string $machine_name
     * @param string $ip
     */
    protected function registerMachine($file_name, $machine_name, $ip) {
        $file_handler = new FileHandler($file_name);
        if (!file_exists($file_name)) {
            $file_handler->createFile();
        }
        if (!$file_handler->nameInFile($machine_name)) {
            $file_handler->addEntryToFile($machine_name, $ip);
            $this->response .= "Machine was registered.";
        } else {
            $this->response .= "Machine is already registered.";
        }
    }

    public function __toString() {
        return $this->response;
    }

}
