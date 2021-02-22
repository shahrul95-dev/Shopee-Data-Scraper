<?php
class product {

  private $db;

  public function __construct($database)
  {
    $this->db = $database;
  }

  public function get_last_product($shopid)
  {
    $query = $this->db->prepare("SELECT * FROM `products_shopee` WHERE `shopid` = ? ORDER BY `id` DESC");
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

  public function get_product($shopid,$itemid)
  {
    $query = $this->db->prepare("SELECT * FROM `products_shopee` WHERE `shopid` = ? AND `itemid` = ? ORDER BY `id` DESC");
    $query->bindValue(1, $shopid);
    $query->bindValue(2, $itemid);

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

  function insert_product($param)
  {
    $strColumn = "";
    $strValue = "";

    $columnName = array (
      "shopid",
      "itemid",
      "images",
      "price",
      "name",
      "stock"
    );

    foreach ($columnName as $column) {
      $strColumn = $strColumn.$column.",";
    }

    $strColumn = substr($strColumn, 0, -1); //remove last character in the string

    foreach ($param as $key => &$value) {
      $strValue = $strValue."?,";
    }

    $strValue = substr($strValue, 0, -1); //remove last character in the string

    $query = $this->db->prepare("INSERT INTO `products_shopee` ($strColumn) VALUES ($strValue)");

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
