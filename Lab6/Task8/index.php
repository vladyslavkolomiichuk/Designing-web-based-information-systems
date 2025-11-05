<?php
// ================= Notification Interfaces =================

// main interface for notification adapters
interface NotificationInterface
{
  public function setData($data);
  public function sendNotification();
}

// interface for manager
interface INotificationManager
{
  public function sendNotification($type = '', $data = []);
}


// ================= External Services (Simulated APIs) =================

// external Twitter service imitation
class TwitterService
{
  private $_data = [];

  public function setMessage($text)
  {
    $this->_data['message'] = $text;
  }

  public function sendTweet()
  {
    echo "Tweet sent: " . ($this->_data['message'] ?? '') . "<br/>";
  }
}

// external SMS service imitation
class SmsService
{
  private $recipient;
  private $message;
  private $time;

  public function setRecipient($r)
  {
    $this->recipient = $r;
  }
  public function setMessage($m)
  {
    $this->message = $m;
  }
  public function setTime($t)
  {
    $this->time = $t;
  }

  public function sendText()
  {
    echo "SMS to {$this->recipient} at {$this->time}: {$this->message}<br/>";
  }
}


// ================= Adapters (Composition Based) =================

// adapter for Twitter
class TwitterAdapter implements NotificationInterface
{
  protected $_data;

  public function setData($data)
  {
    $this->_data = $data;
  }

  public function sendNotification()
  {
    $client = new TwitterService();
    $client->setMessage($this->_data['message']);
    $client->sendTweet();
  }
}

// adapter for SMS
class SmsAdapter implements NotificationInterface
{
  protected $_data;

  public function setData($data)
  {
    $this->_data = $data;
  }

  public function sendNotification()
  {
    $client = new SmsService();
    $client->setRecipient($this->_data['recipient']);
    $client->setMessage($this->_data['message']);

    // if time is not provided, use current time
    $time = $this->_data['time'] ?? date('H:i');
    $client->setTime($time);

    $client->sendText();
  }
}


// ================= Notification Manager =================

class NotificationManager implements INotificationManager
{
  public function sendNotification($type = '', $data = [])
  {
    switch ($type) {
      case "twitter":
        $notify = new TwitterAdapter();
        break;
      case "sms":
        $notify = new SmsAdapter();
        break;
      default:
        echo "Error: unknown notification type<br/>";
        return false;
    }

    $notify->setData($data);
    $notify->sendNotification();
    return true;
  }
}


// ================= Demonstration =================

echo "<h3>Notification Adapters Demonstration</h3>";

$manager = new NotificationManager();

// sending a tweet
$manager->sendNotification("twitter", [
  "message" => "Hello from adapter pattern!"
]);

// sending sms with scheduled time
$manager->sendNotification("sms", [
  "recipient" => "+380991112233",
  "message" => "Meeting at university.",
  "time" => "14:30"
]);

// sending sms immediately (no time → current time)
$manager->sendNotification("sms", [
  "recipient" => "+380992223344",
  "message" => "Reminder: Submit report."
]);
