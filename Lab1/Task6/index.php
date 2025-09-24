<?php header("Content-Type: text/html; charset=windows-1251");
class WorkWithFile

{
  public $buff;
  public $filename;

  public function __construct($filename)
  {
    $uploadDir = './';
    $this->filename = $uploadDir . $filename;

    if (!file_exists($this->filename)) {
      exit("File does not exist");
    }

    //file opening
    $fd = fopen($filename, "r");

    if (!$fd) {
      exit("File open error");
    }

    $this->buff = fread($fd, filesize($this->filename));
    fclose($fd);
  }

  // The method displays the contents of the //file on the function screen
  public function getContent()
  {
    return $this->buff;
  }

  // The method displays the file size
  public function getSize()
  {
    return filesize($this->filename);
  }

  // The method outputs the number of lines in the //function file
  public function getCount()
  {
    if (!empty($this->filename)) {
      $arr = file($this->filename);
      return count($arr);
    } else {
      return 0;
    }
  }

  // The method for modifying file by adding date in it's bottom
  public function modifyWithDate()
  {
    // Get current date and time
    $currentDateTime = date("Y-m-d H:i:s");

    // Read all lines into an array
    $lines = file($this->filename, FILE_IGNORE_NEW_LINES);

    // If the last line looks like a date (YYYY-MM-DD HH:MM:SS), remove it
    if (!empty($lines) && preg_match('/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/', trim(end($lines)))) {
      array_pop($lines);
    }

    // Add the new date at the end
    $lines[] = $currentDateTime;

    // Rewrite the file with the updated content
    file_put_contents($this->filename, implode("\n", $lines));

    // Update the buffer inside the class
    $this->buff = implode("\n", $lines);
  }
}

$first = new WorkWithFile("count.txt");

echo "{$first->getContent()}<br><br>";
echo "{$first->getsize()}<br><br>";
echo "{$first->getCount()}<br><br>";

$first->modifyWithDate();
echo "{$first->getContent()}<br><br>";
