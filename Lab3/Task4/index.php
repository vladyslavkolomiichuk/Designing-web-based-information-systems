<?php
// Interface definition
interface ILogger
{
  // Method that must be implemented
  public function log($message);
}

// Class that implements the interface and writes logs to a file
class FileLogger implements ILogger
{
  private $file;
  private $logFile;

  public function __construct($filename, $mode = 'a')
  {
    $this->logFile = $filename;
    $this->file = fopen($filename, $mode) or die('Could not open the log file');
  }

  // Redefinition of the “log” method
  public function log($message)
  {
    $message = date("F j, Y, g:i a") . ': ' . $message . "\n";
    fwrite($this->file, $message);
  }

  // Destructor closes the file automatically
  public function __destruct()
  {
    if ($this->file) {
      fclose($this->file);
    }
  }
}

// Demonstration of functionality

$FLog = new FileLogger('./log.txt', 'w');
$FLog->log('Log message');
$FLog->log('Another log message');

echo "Messages were successfully written to log.txt<br>";
