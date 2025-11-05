<?php
// Define an interface that requires a logMessage() method
interface ILogger
{
  public function logMessage($message);
}

trait DateTimeTrait
{
  // Returns formatted date and time
  public function getCurrentDateTime()
  {
    return date("F j, Y, g:i a");
  }
}

trait FileWriteTrait
{
  // Append text to the specified file
  public function writeToFile($filename, $text)
  {
    file_put_contents($filename, $text, FILE_APPEND);
  }
}

class FileLogger implements ILogger
{
  use DateTimeTrait, FileWriteTrait;

  private $fileName;

  // Constructor to set the log file name
  public function __construct($fileName)
  {
    $this->fileName = $fileName;
  }

  // Method to log a message into the file
  public function logMessage($message)
  {
    // Get current timestamp
    $timestamp = $this->getCurrentDateTime();

    // Prepare a log entry
    $logEntry = "$timestamp: $message" . PHP_EOL;

    // Write the entry to the log file
    $this->writeToFile($this->fileName, $logEntry);

    // Print a confirmation message to the screen
    echo "Message successfully written to the log file!<br>";
  }
}

// Create an instance of FileLogger
$logger = new FileLogger("log.txt");

// Add messages to the log file
$logger->logMessage("First log message");
$logger->logMessage("Another message");
