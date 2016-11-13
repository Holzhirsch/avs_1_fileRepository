<?php

/**
 * @author era
 * 
 * Description of DirectoryService:
 * Class to login and send needed data to the functions.
 */
class DirectoryService {

    protected $response = "";

    public function __construct() {
        $this->password =       isset($_POST["pass"]) ? $_POST["pass"] : null;
        $this->account =        isset($_POST["acc"]) ? $_POST["acc"] : null;
        $this->function =       isset($_POST["function"]) ? $_POST["function"] : null;
        $this->machine_name =   isset($_POST["machine_name"]) ? $_POST["machine_name"] : null;
        $this->ip =             isset($_POST["ip"]) ? $_POST["ip"] : null;
    }

    public function start() {
        if (empty($this->password) || empty($this->account) || empty($this->function)) {
            Utils::sendResponse("No password, account or operation set.");
        }
        if (!$this->logIn()) {
            Utils::sendResponse("Login error.");
        } else {
            Utils::echoDebug("Login success");
            $this->file_name = $this->account . $this->password;
            $this->response .= $this->startFunction();
            Utils::sendResponse($this->response);
        }
    }

    /**
     * Checks given password and account against hardcoded strings.
     * @return boolean true if successful login, false if not
     */
    protected function logIn() {
        Utils::echoDebug("Attempt Login with password: " . $this->password . ", account: " . $this->account);
        return ($this->password != "king" || $this->account != "acc") ? false : true;
    }

    /**
     * Sends the needed data to the requested functions.
     * @return string response of the function
     */
    protected function startFunction() {
        Utils::echoDebug("Start function: " . $this->function);
        switch ($this->function) {
            case "register":
                $reg = new Register($this->file_name, $this->machine_name, $this->ip);
                return (String) $reg;
            case "unregister":
                $unreg = new Unregister($this->file_name, $this->machine_name);
                return (String) $unreg;
            case "query":
                $query = new Query($this->file_name);
                return (String) $query;
        }
    }

}
