<?php
  //外部ファイル読み込み
  require_once __DIR__."/def.php";
  require_once "getInfo.php";

  /** 
   * 全員の詳細を表示と検索
   * 
  */
  
  function DetailSearch(){

    //FROMからデータを取得
    if(isset($_POST['btn_submit'])){
      //名
      $name = filter_input(INPUT_POST,"name");
      // 店舗
      $store = filter_input(INPUT_POST,"store_id");
      //部署
      $section = filter_input(INPUT_POST,"section_id");
      // 役職
      $roll = filter_input(INPUT_POST, "roll");
      //安否確認
      $condition = filter_input(INPUT_POST,"condition");
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

      $sql =
       'SELECT u.user_id, u.first_name, u.last_name, u.section_id, se.section_name, s.store_id, s.store_name, c.condition, c.isAttend 
        FROM user AS u 
        LEFT JOIN contact AS c ON u.user_id = c.user_id 
        JOIN store AS s ON u.store_id = s.store_id 
        JOIN section AS se ON u.section_id = se.section_id 
        ORDER BY u.user_id';

      //検索 
      if(isset($_GET['btn_submit'])){
        if(isset($_GET['store_id'])){
          $sql .= " WHERE s.store_id = :store_id";
          echo 'store_id:' . $store;
        }

        if(isset($_GET['role'])){
          $sql .= " WHERE u.role = :role";
        }
        
        if(isset($_GET['section_id'])){
          $sql .= " WHERE u.section_id = :section_id";
        }

        //文字検索
        if(isset($_GET['name'])){
          $sql .= " WHERE u.first_name LIKE :name OR u.last_name LIKE :name ";
          $nameLike = "%".$name."%";
        }

        //格納
        $stmt = $db -> prepare($sql);

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

      //PDOオブジェクトの廃棄
      $stmt = null;
      $db = null;

    }catch(PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
    }
    return $result;
  }

?>

