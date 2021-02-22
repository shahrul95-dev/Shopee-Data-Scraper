<?php

class Shop {

  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  public function get_shop($shopid)
  {
    $query = $this->db->prepare("SELECT * FROM `shop_shopee` WHERE `shopid` = ?");
    $query->bindValue(1, $shopid);

    try {

      if ($query->execute()) {
        return $query->fetch();
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }

  public function get_all_shop()
  {
    $query = $this->db->prepare("SELECT * FROM `shop_shopee`");

    try {

      if ($query->execute()) {
        return $query->fetchAll();
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }

  public function get_all_shop_only_shopid()
  {
    $query = $this->db->prepare("SELECT `shopid` FROM `shop_shopee`");

    try {

      if ($query->execute()) {
        return $query->fetchAll();
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }

  function insert_shop($param)
  {
    $strColumn = "";
    $strValue = "";

    $columnName = array (
      "userid",
      "shopid",
      "username"
    );

    foreach ($columnName as $column) {
      $strColumn = $strColumn.$column.",";
    }

    $strColumn = substr($strColumn, 0, -1); //remove last character in the string

    foreach ($param as $key => &$value) {
      $strValue = $strValue."?,";
    }

    $strValue = substr($strValue, 0, -1); //remove last character in the string

    $query = $this->db->prepare("INSERT INTO `shop_shopee` ($strColumn) VALUES ($strValue)");

    foreach ($param as $key => &$value) {
      $query->bindValue($key, $value);
    }

    try {

      if ($query->execute()) {
        return true;
      } else {
        return false;
      }

    } catch (PDOException $e) {
      die ($e->getMessage());
    }
  }

}

 ?>
