<?php
class ShellProcess {
    private $pid;
    private $command;
    private $exit_code;

    public function __construct($cl=false) {
        if ($cl != false) {
            $this->command = $cl;
            $this->runCom();
        }
    }
    private function runCom() {
        $command = 'nohup '.$this->command.' 2>&1';
        exec($command ,$op, $exit_code);
        $this->exit_code = $exit_code;
        $this->pid = (int)$op[0];
    }

    public function setPid($pid) {
        $this->pid = $pid;
    }

    public function getPid() {
        return $this->pid;
    }
    
    public function getExitCode() {
        return $this->exit_code;
    }

    public function status() {
        $command = 'ps -p '.$this->pid;
        exec($command,$op);
        if (!isset($op[1])) return false;
        else return true;
    }

    public function start() {
        if ($this->command != '') $this->runCom();
        else return true;
    }

    public function stop() {
        $command = 'kill '.$this->pid;
        exec($command);
        if ($this->status() == false) return true;
        else return false;
    }
}
?>