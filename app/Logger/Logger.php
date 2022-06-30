<?php

namespace app\Logger;

class Logger
{
    private $date;
    private $ip;
    private $role;
    private $logFile;
    private $fileAdress;
    
    public function setup($role)
    {
        $this->role = $role;
        $this->date = date('Y-m-d');
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->logFile= $this->date.".log";

        if (!is_dir("../Logs")){
            mkdir("../Logs");
        }
        if (!is_dir("../Logs/Admin")){
            mkdir("../Logs/Admin");
        }
        if (!is_dir("../Logs/Mod")){
            mkdir("../Logs/Mod");
        }
    }
 
    public function log(string $message, string $level, $username, string $role)
    {
       $this->setup($role);
       if ($this->role == 'admin' || $this->role == 'mod'){
            $this->fileAdress = fopen('../Logs/Admin'."/".$this->logFile,'a');
            fwrite($this->fileAdress,"Ip:[".$this->ip."] Username:[".$username."] Role:[".$role."] Date:[".date("Y-m-d H:i:s")."] Level:[".$level."] Log:[".$message."]".PHP_EOL);
            fclose($this->fileAdress);

        }else{
            $this->fileAdress = fopen('../Logs/Admin'."/".$this->logFile,'a');
            fwrite($this->fileAdress,"Ip:[".$this->ip."] Username:[".$username."] Role:[".$role."] Date:[".date("Y-m-d H:i:s")."] Level:[".$level."] Log:[".$message."]".PHP_EOL);
            fclose($this->fileAdress);

            $this->fileAdress = fopen('../Logs/Mod'."/".$this->logFile,'a');
            fwrite($this->fileAdress,"Ip:[".$this->ip."] Username:[".$username."] Role:[".$role."] Date:[".date("Y-m-d H:i:s")."] Level:[".$level."] Log:[".$message."]".PHP_EOL);
            fclose($this->fileAdress);
        }
    }
}