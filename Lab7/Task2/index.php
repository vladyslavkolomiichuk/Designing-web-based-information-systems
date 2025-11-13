<?php

/**
 * Abstract payment handler
 */
abstract class PaymentHandler
{
  /**
   * @var PaymentHandler
   */
  protected $next;

  /**
   * Set next handler
   * @param PaymentHandler $handler
   * @return PaymentHandler
   */
  public function setNext($handler)
  {
    $this->next = $handler;
    return $handler;
  }

  /**
   * Process payment request
   * @param float $amount
   * @return void
   */
  abstract public function pay($amount);
}

/**
 * Handle payment from main account
 */
class MainAccountHandler extends PaymentHandler
{
  /**
   * @var float
   */
  private $balance;

  /**
   * @param float $balance
   */
  public function __construct($balance)
  {
    $this->balance = $balance;
  }

  /**
   * @param float $amount
   */
  public function pay($amount)
  {
    if ($this->balance >= $amount) {
      echo "Payment of $amount completed from Main Account.";
    } else {
      if ($this->next) {
        $this->next->pay($amount);
      }
    }
  }
}

/**
 * Handle payment from credit card
 */
class CreditCardHandler extends PaymentHandler
{
  /**
   * @var float
   */
  private $creditBalance;

  /**
   * @param float $creditBalance
   */
  public function __construct($creditBalance)
  {
    $this->creditBalance = $creditBalance;
  }

  /**
   * @param float $amount
   */
  public function pay($amount)
  {
    if ($this->creditBalance >= $amount) {
      echo "Payment of $amount completed from Credit Card.";
    } else {
      if ($this->next) {
        $this->next->pay($amount);
      } else {
        echo "Payment declined. Not enough funds.";
      }
    }
  }
}

// Usage example
$main = new MainAccountHandler(50);
$credit = new CreditCardHandler(100);

$main->setNext($credit);

$amount = 70;
$main->pay($amount);
