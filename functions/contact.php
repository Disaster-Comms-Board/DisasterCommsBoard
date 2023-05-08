<?php
require_once "def.php";

/**
 * 登録済みの連絡情報を取得
 *
 * @return array $result 連絡情報の配列
 */
function checkContact(){
    $user_id = $_SESSION['user_id'];

    try{
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM contact WHERE user_id = :user_id";

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
 * 連絡情報の新規登録
 *
 * @return void
 */
function addContact(){
    $user_id = $_SESSION['user_id'];
    $condition = ($_POST['condition'] == '1');
    $isAttend = ($_POST['isAttend'] == '1');
    $detail = $_POST['detail'];

    try{
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO contact VALUES (:user_id, :condition, :isAttend, :detail)";

        $stmt = $db -> prepare($sql);

        $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt -> bindParam(':condition', $condition, PDO::PARAM_BOOL);
        $stmt -> bindParam(':isAttend', $isAttend, PDO::PARAM_BOOL);
        $stmt -> bindParam(':detail', $detail, PDO::PARAM_STR);

        $stmt -> execute();
        $db -> commit();

    } catch (PDOException $poe){
        exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }
}

/**
 * 連絡情報の編集
 *
 * @return void
 */
function editContact(){
    $user_id = $_SESSION['user_id'];
    $condition = ($_POST['condition'] == '1');
    $isAttend = ($_POST['isAttend'] == '1');
    $detail = $_POST['detail'];

    try{
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
        $db = new PDO($dsn, DB_USER, DB_PASS);
        $db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $db -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE contact SET `condition` = :condition, isAttend = :isAttend, detail = :detail WHERE user_id = :user_id";

        $stmt = $db -> prepare($sql);

        $stmt -> bindParam(':condition', $condition, PDO::PARAM_BOOL);
        $stmt -> bindParam(':isAttend', $isAttend, PDO::PARAM_BOOL);
        $stmt -> bindParam(':detail', $detail, PDO::PARAM_STR);
        $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_STR);

        $stmt -> execute();
        $db -> commit();

    } catch (PDOException $poe){
        exit("DBエラー".$poe -> getMessage());
    } finally {
      $stmt = null;
      $db = null;
    }
}

?>