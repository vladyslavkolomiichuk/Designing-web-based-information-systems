<?php
class A
{
  public static function test()
  {
    echo 1;
  }

  public static function get()
  {
    static::test(); // Now method get() calls static method test() from B class due to special word static
  }
}

class B extends A
{
  public static function test()
  {
    echo 2;
  }
}

B::get();
