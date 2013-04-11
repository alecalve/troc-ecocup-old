<?php

class BDD extends PDO
{
    private $DB_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
    
    public function __construct($host, $name, $user, $pass) {
        try {
        parent::__construct('mysql:host='.$host.';dbname='.$name, $user, $pass, $this->DB_OPTIONS);
        }
        catch (PDOException $e) { BDD::meurt('__construct',$e); }
    }
    public function execute($statement)
    {
        try { 
            return $statement->execute(); 
        }
        catch (PDOException $e) { BDD::meurt('execute',$e); }
    }
    public function exec($statement)
    {
        try { 
            return parent::exec($statement); 
        }
        catch (PDOException $e) { BDD::meurt('exec',$e); }
    }
    public function query($statement)
    {
        try { 
            return parent::query($statement); 
            }
        catch (PDOException $e) { BDD::meurt('query',$e); }
    }
    private static function meurt($type, PDOException $e)
    {
        die('SQL Error : '.$e.' '.$type);
    }
}
?>
