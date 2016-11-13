<?php

/**
 * @author era
 * 
 * Description of FileHandler:
 * Class to handle file methods.
 * @param String $file_name the name of the file, where machine and ip are stored
 * @param String $machine_name the machine_name
 * @param String $ip the ip adress of the machine
 */
class FileHandler {

    public function __construct($file_name) {
        $this->file_name = $file_name;
    }
    
    /**
     * Creates a file with given file name.
     */
    public function createFile() {
        Utils::echoDebug("Create file: " . $this->file_name);
        $handle = fopen($this->file_name, "w+");
        fclose($handle);
    }

    /**
     * Checks whether entry with given machine name is in the given file.
     * @param string $machine_name
     * @return boolean true if name is in file, false if not
     */
    public function nameInFile($machine_name) {
        $entries = file($this->file_name);
        foreach ($entries AS $line) {
            $line = rtrim($line); //remove whitespace at end of string
            $entry = unserialize($line);

            if ($entry[0] === $machine_name) {
                Utils::echoDebug("Entry: " . $machine_name . " is in file: " . $this->file_name);
                return true;
            }
        }
        Utils::echoDebug("Entry: " . $machine_name . " is not in file: " . $this->file_name);
        return false;
    }

    /**
     * Adds given entry to given file.
     * @param string $machine_name
     * @param string $ip
     */
    public function addEntryToFile($machine_name, $ip) {
        Utils::echoDebug("Add entry: " . $machine_name . ", ip: " . $ip . " to file: " . $this->file_name);
        $data_array = array($machine_name, $ip);
        $entry = serialize($data_array) . "\r\n";
        file_put_contents($this->file_name, $entry, FILE_APPEND);
    }

    /**
     * Removes entry with given name from given file.
     * @param string $machine_name
     */
    public function removeEntryFromFile($machine_name) {
        Utils::echoDebug("Remove entry: " . $machine_name . " from file: " . $this->file_name);
        $entries = file($this->file_name);
        $this->createFile();
        foreach ($entries AS $line) {
            $line = rtrim($line);
            $array = unserialize($line);
            if ($array[0] != $machine_name) {
                $this->addEntryToFile($array[0], $array[1]);
            }
        }
    }

    /**
     * Returns all entries in given file.
     * @return string
     */
    public function getRegisteredMachines() {
        Utils::echoDebug("Get all entries from file: " . $this->file_name);
        $entries = file($this->file_name);
        $response = "Entries:<br>";
        if (empty($entries)) {
            $response .= "No registered machines.";
        }
        foreach ($entries AS $line) {
            $line = rtrim($line);
            $entry = unserialize($line);
            $response .= "Name: " . $entry[0] . ", IP: " . $entry[1] . "<br>";
        }
        return $response;
    }

}
