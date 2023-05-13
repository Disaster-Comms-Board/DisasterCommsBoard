<?php
require_once "def.php";

$all_role = [
  'Admin' => '管理者',
  'Employee' => '社員',
  'Part' => 'アルバイト'
];

/**
 * 部署の表示
 *
 * @return array $sections 部署の配列
 */
function getSections(){
    try{
      $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
      $db = new PDO($dsn, DB_USER, DB_PASS);
      $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
      $sql = "SELECT * FROM section";
      $stmt = $db -> prepare($sql);
      $stmt -> execute();
  
      $sections = [];
      while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $sections[] = $rows;
      }
          
    } catch (PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }
  
    return $sections;
  }
  
  /**
   * 店舗の表示
   * 
   * @return array $stores 店舗の配列
   */

  function getStores(){
    try{
      $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
      $db = new PDO($dsn, DB_USER, DB_PASS);
      $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
      $sql = "SELECT * FROM store";
      $stmt = $db -> prepare($sql);
      $stmt -> execute();
     
      $stores = [];
      while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $stores[] = $rows;
      }
    } catch (PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }
  
    return $stores;
  }
  
  
?>