<?php
  //外部ファイル読み込み
  require_once __DIR__."/def.php";
  require_once "getInfo.php";

  /** 
   * 全員の詳細を表示と検索
   * 
  */
  
  function detailSearch(){

    //FROMからデータを取得
    if(isset($_GET['btn_submit'])){
      //名
      $name = filter_input(INPUT_GET,"name");
      // 店舗
      $store = filter_input(INPUT_GET,"store_id");
      //部署
      $section = filter_input(INPUT_GET,"section_id");
      // 役職
      $roll = filter_input(INPUT_GET, "roll");
      //安否確認
      $condition = filter_input(INPUT_GET,"condition");
    }

    // データベース接続処理
    //情報(ホスト名、DB名、文字コード)
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;

    try{
      //PDOインスタンス(情報、ログインID、PASSWORD)
      $db = new PDO($dsn,DB_USER,DB_PASS);
      $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

      //SQL文準備
      // $sql = "SELECT u.user_id,u.first_name,u.last_name,u.section_id,se.section_name,s.store_id,s.store_name,c.condition,c.isAttend,u.role FROM user AS u 
      //         LEFT JOIN contact AS c ON(u.user_id = c.user_id) 
      //         JOIN store AS s ON (u.store_id = s.store_id)
      //         JOIN section AS se ON (u.section_id = se.section_name)";

      $sql = 'SELECT * FROM usersList';

      //検索 
      if(isset($_GET['btn_submit'])){
        if(isset($_GET['store_id']) || isset($_GET['role']) || isset($_GET['section_id']) || $_GET['name'] != ''){
          $sql .= " WHERE";
          if(isset($_GET['store_id'])){
            $sql .= "s.store_id = :store_id";
          }
  
          if(isset($_GET['role'])){
            $sql .= "u.role = :role";
          }
          
          if(isset($_GET['section_id'])){
            $sql .= "u.section_id = :section_id";
          }
  
          //文字検索
          if($_GET['name'] != ''){
            $sql .= "u.first_name LIKE :name OR u.last_name LIKE :name ";
            $nameLike = "%".$name."%";
          }
        }

        echo $sql;

        //格納
        $stmt = $db -> prepare($sql);

        if(isset($_GET['store_id']) || isset($_GET['role']) || isset($_GET['section_id']) || $_GET['name'] != ''){
          if(isset($_GET['store_id'])){
            $stmt -> bindParam(":store_id",$store_id,PDO::PARAM_STR);
          }
          if(isset($_GET['role'])){
            $stmt -> bindParam(":role",$role,PDO::PARAM_STR);
          }
          if(isset($_GET['section_id'])){
            $stmt -> bindParam(":section_id",$section_id,PDO::PARAM_STR);
          }
          if(isset($_GET['name'])){
            $stmt -> bindParam(":name",$nameLike,PDO::PARAM_STR);
          }
        }

        $stmt -> execute();
        //処理結果の格納
        $result = [];
        while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
          $result[] = $rows;
        }

      }else{
        //格納
        $stmt = $db -> prepare($sql);

        //実行
        $stmt -> execute();

        //処理結果の格納
        $result = [];
        while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
          $rows['isContact'] = (is_null($rows['isAttend'])) ? 0 : 1;
          $result[] = $rows;
        }
      }
    } catch (PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
    } finally {
      //PDOオブジェクトの廃棄
      $stmt = null;
      $db = null;
    }
    return $result;
  }

?>

