<?php
  //外部ファイル読み込み
  require_once __DIR__."/def.php";
  require_once "getInfo.php";

  //echo DB_HOST . ":" . DB_USER;

  $all_store = getStores();

  //FROMからデータを取得
  if(isset($_POST['btn_submit'])){
    //名
    $name = filter_input(INPUT_POST,"name");
    // 店舗
    $store = filter_input(INPUT_POST,"store");

    //安否確認
    $condition = filter_input(INPUT_POST,"condition");
    //出社状況
    $isAttend = filter_input(INPUT_POST,"isAttend");

  }

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
            JOIN store AS s ON (u.store_id = s.store_id)";

    //検索 
    if(isset($_POST['btn_submit'])){
      if(isset($_POST['store'])){
        $sql .= " WHERE s.store_id = :store";
        echo 'store:' . $store;
      }

      if(isset($_POST['role'])){
        $sql .= " WHERE u.role = :role";
      }
      
      if(isset($_POST['condition'])){
        $sql .= " WHERE c.condition = :condition";
      }

      //文字検索
      if(isset($_POST['name'])){
        $sql .= " WHERE u.first_name LIKE :name OR u.last_name LIKE :name ";
        $nameLike = "%".$name."%";
      }


      //格納
      $stmt = $db -> prepare($sql);

      $stmt -> bindParam(":store",$store,PDO::PARAM_STR);
      $stmt -> bindParam(":role",$role,PDO::PARAM_STR);
      $stmt -> bindParam(":condition",$condition,PDO::PARAM_STR);
      $stmt -> bindParam(":name",$nameLike,PDO::PARAM_STR);


      $stmt -> execute();
      //処理結果の格納
      $result = [];
      while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $result[] = $rows;
      }
    }else{

      //連絡有無　入力があれば
      if(is_null($isAttend)){
        $isContact = "○";
      }else{
        $isContact = "×";
      }
      
      //格納
      $stmt = $db -> prepare($sql);

      //実行
      $stmt -> execute();

      //処理結果の格納
      $result = [];
      while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $result[] = $rows;
      }
    }

    //PDOオブジェクトの廃棄
    $stmt = null;
    $db = null;

  }catch(PDOException $poe){
    exit("DBエラー".$poe -> getMessage());
  }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<form action="" method="POST" class="mt-5 m-3">

  <!-- 検索 -->
  <div class="row">
    <label class="form-label" for="name">NAME</label>
    <input class="form-control form-control-lg" type="text" name="name">
  </div><!-- .row -->

  <div class="row">
    <label class="form-label" for="store">店舗</label>
    <select class="form-select form-select-lg mb-3" name="store">
        <?php foreach($all_store as $one_store):?>
        <option value="<?=$one_store['store_id'] ?>"><?=$one_store['store_name']?></option>
        <?php endforeach?>
    </select>
  </div><!-- .row -->

  <button name="btn_submit">検索</button>

</form>

  <table>
    <tr>
    <table class="table table-hover mt-5 form-control-lg">
            <thead class="table-light text-secondary">
              <tr>
                <th>ID</th>
                <th>名前</th>
                <th>店舗</th>
                <th>連絡</th>
                <th>連絡２</th>
                <th>連絡３</th>
              </tr>

            </thead>
            <tbody>
              <?php foreach($result as $res): ?>
                <tr>
                  <td><?=$res["user_id"] ?></td>
                  <td><?=$res["first_name"] ?> <?=$res["last_name"] ?></td>
                  <td><?=$res["store_name"] ?></td>
                  <td><?=$res["condition"] ?></td>

                </tr>
              <?php endforeach; ?>

            </tbody>
        </table>

    </tr>
  </table>
</body>
</html>

