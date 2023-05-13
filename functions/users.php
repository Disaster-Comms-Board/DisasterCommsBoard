<?php
require_once "def.php";

/**
 * 社員番号、電話番号の一致確認
 *
 * 古いデータベースに登録があるかを確認する
 * 
 * @return array $result エラー、役職の配列
 */
function confirmOld() {
    $user_id = $_POST['user_id'];
    $phone_number = $_POST['phone_number'];
    
    try{
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM old WHERE user_id = :old AND phone_number = :phone_number";
        $stmt = $db -> prepare($sql);
        
        $stmt -> bindParam(':old', $user_id, PDO::PARAM_STR);
        $stmt -> bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        
        $stmt -> execute();
        
        // 実行結果の行数を取得
        $old_count = $stmt -> rowCount();

        if($old_count == 1) {
          // userテーブルにuser_idが一致するものがあるか確認する
          $user_count = count(getUser($user_id));
          if($user_count == 0){
            while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
              $result = [
                'error' => false,
                'role' => $rows['role']
              ];
            }
          } else {
            $result = [
              'error' => true,
              'message' => '既にユーザー登録が完了しています'
            ];
          }
        } else if($old_count == 0) {
          // 該当なし
          $result = [
            'error' => true,
            'message' => '社員IDか電話番号が間違えています'
          ];
        }

      } catch (PDOException $poe) {
        exit("DBエラー".$poe -> getMessage());
      } finally {
        $stmt = null;
        $db = null;
      }

      return $result;
}

/**
 * ユーザをuserテーブルに登録する
 *
 * @param int $role 役職
 * @return void
 */
function addUser($role){
    // 入力情報
    $user_id = $_POST['user_id'];
    $phone_number = $_POST['phone_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $e_mail = $_POST['e_mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);;
    // $address = $_POST['address'];
    $section_id = $_POST['section_id'];
    if($section_id == 3){
      $store_id = $_POST['store_id'];
    } else {
      $store_id = 0;
    }
    
    try{
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO user (user_id, phone_number, first_name, last_name, `password`, e_mail, section_id, store_id, role) VALUES (:user_id, :phone_number, :first_name, :last_name
                , :pw, :e_mail, :section_id, :store_id, :role)";

        $stmt = $db -> prepare($sql);

        $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt -> bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
        $stmt -> bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt -> bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt -> bindParam(':pw', $password, PDO::PARAM_STR);
        $stmt -> bindParam(':e_mail', $e_mail, PDO::PARAM_STR);
        // $stmt -> bindParam(':address', $address, PDO::PARAM_STR);
        $stmt -> bindParam(':section_id', $section_id, PDO::PARAM_STR);
        $stmt -> bindParam(':store_id', $store_id, PDO::PARAM_STR);
        $stmt -> bindParam(':role', $role, PDO::PARAM_STR);

        $stmt -> execute();
        $db -> commit();

        header("location: ../view/LoginScreenPage.php");

    } catch (PDOException $poe){
        exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }
}

/**
 * userテーブルからユーザ情報取得
 *
 * @param string $user_id 社員番号
 * @return array $result ユーザ情報の配列
 */
function getUser($user_id){
  try{
      $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
      $db = new PDO($dsn, DB_USER, DB_PASS);
      $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
      $sql = "SELECT u.user_id, u.first_name, u.last_name, u.role, u.phone_number,u.e_mail, u.section_id, se.section_name
      , s.store_id, s.store_name, c.condition, c.isAttend, c.detail
      FROM user AS u 
      LEFT JOIN contact AS c ON u.user_id = c.user_id 
      JOIN store AS s ON u.store_id = s.store_id 
      JOIN section AS se ON u.section_id = se.section_id 
      WHERE u.user_id = :user_id";
      $stmt = $db -> prepare($sql);
      
      $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_STR);
      $stmt -> execute();
      
      $result = [];
      while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $result[] = $rows;
      }
      
    } catch (PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }

  return $result;
}

/**
 * ログイン処理
 *
 * @return bool $success ログインの可否
 */
function login(){
  $user_id = $_POST['user_id'];
  $password = $_POST['password'];

  $user = getUser($user_id)[0];
  $success = password_verify($password, $user['password']);

  if($success){
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['full_name'] = $user['last_name'] . $user['first_name'];
  }

  return $success;
}

/**
 * パスワードの一致を確認
 * 
 * プロフィールのアップデート処理に使用
 *
 * @param string $user_id 社員番号
 * @param string $password 入力パスワード
 * @return bool $success パスワードが一致したかどうか
 */
function checkPW($user_id, $password){
  $user = getUser($user_id)[0];
  $success = password_verify($password, $user['password']);

  return $success;
}

/**
 * ユーザーデータのアップデート
 *
 * @return void
 */
function updateUser(){
  // 入力情報
  $user_id = $_SESSION['user_id'];
  $phone_number = $_POST['phone_number'];

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $e_mail = $_POST['e_mail'];
  // $address = $_POST['address'];
  $section_id = $_POST['section_id'];
  $store_id = $_POST['store_id'];

  try{
      $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
      $db = new PDO($dsn, DB_USER, DB_PASS);
      $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql 
        = "UPDATE user SET phone_number = :phone_number, first_name = :first_name
          , last_name = :last_name, e_mail = :e_mail, section_id = :section_id, store_id = :store_id 
          WHERE user_id = :user_id";

      $stmt = $db -> prepare($sql);

      $stmt -> bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
      $stmt -> bindParam(':first_name', $first_name, PDO::PARAM_STR);
      $stmt -> bindParam(':last_name', $last_name, PDO::PARAM_STR);
      $stmt -> bindParam(':e_mail', $e_mail, PDO::PARAM_STR);
      // $stmt -> bindParam(':address', $address, PDO::PARAM_STR);
      $stmt -> bindParam(':section_id', $section_id, PDO::PARAM_STR);
      $stmt -> bindParam(':store_id', $store_id, PDO::PARAM_STR);
      $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_STR);

      $stmt -> execute();
      $db -> commit();

      echo 'UPDATE成功';

  } catch (PDOException $poe){
      exit("DBエラー".$poe -> getMessage());
  } finally {
    $stmt = null;
    $db = null;
  }

  $_SESSION['full_name'] = $last_name . $first_name;
}
?>

