<?php

  //外部ファイル読み込み
  require_once __DIR__."/def.php";
  require_once "getInfo.php";

  $all_store = getStores();

  //FROMからデータを取得
  $user_id = filter_input(INPUT_GET,"user_id");


  // データベース接続処理
  
  //情報(ホスト名、DB名、文字コード)
  $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

  try{
    //PDOインスタンス(情報、ログインID、PASSWORD)
    $db = new PDO($dsn,DB_USER,DB_PASS);
    $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    //SQL文準備
    $sql = "SELECT u.user_id,u.first_name,u.last_name,s.store_id, s.store_name,c.condition,c.isAttend,u.role FROM user AS u 
            LEFT JOIN contact AS c ON(u.user_id = c.user_id) 
            JOIN store AS s ON (u.store_id = s.store_id)
            WHERE u.user_id = :user_id";

    //格納
    $stmt = $db -> prepare($sql);

    $stmt -> bindParam(":user_id",$user_id,PDO::PARAM_STR);

    $stmt -> execute();
    //処理結果の格納
    $result = [];
    while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
      $result[] = $rows;
    }


  }catch(PDOException $poe){
    exit("DBエラー".$poe -> getMessage());
  }

?>
