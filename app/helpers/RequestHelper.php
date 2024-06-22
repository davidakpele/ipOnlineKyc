<?php
namespace Request\Method;

class RequestHelper 
{
  public static function isRequestMethod($method){
      return $_SERVER['REQUEST_METHOD']=== strtoupper($method);
  } 
}