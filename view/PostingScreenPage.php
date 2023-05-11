<?php
require_once '../functions/contact.php';

session_start();
$user_id = $_SESSION['user_id'];

$isset_contact = checkContact();

if($isset_contact){
    $contact = fetchContact()[0];
    $title = '編集';
} else {
  $title = '新規投稿';
}

$message = '';
if(isset($_POST['btn_submit'])){
  if($isset_contact){
      // 連絡情報が登録されていたら表示->編集
      editContact();
      $message = '編集完了しました';
  } else {
      // 登録されていなかったら新規登録
      addContact();
      $message = '登録完了しました';
  } 
  $contact = fetchContact()[0];
  header('refresh:1;url=MainScreenPage.php');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>安否確認 投稿</title>
  <style>
    /* ポップアップ用ｃｓｓ */
    #pop-up {
      display: none; /* label でコントロールするので input は非表示にする */
    }
    .overlay {
      display: none; /* input にチェックが入るまでは非表示にする */
    }
    #pop-up:checked + .overlay {
      display: block;
      z-index: 9999;
      background-color: #00000070;
      position: fixed;
      width: 100%;
      height: 100vh;
      top: 0;
      left: 0;
    }
  </style>
</head>
<body>
  <?php
  include 'header.php'; ?>
  <!-- メイン -->
  <main>
    <div class="flex justify-center">
      <div class="w-full border border-black mx-96 mt-6 md:mt-10 mb-5 py-5 rounded-2xl">
        <form action="" method="POST">
          <!-- 新規投稿 -->
          <h2 class="text-3xl mt-3 font-bold text-center"><?=$title?></h2>
          
          <!-- 安否確認(本人) -->
          <div class="mx-6 md:ml-24">
            <div class="font-bold mt-3 mb-1">安否確認(本人)</div>
            <!-- 無事、有事チェック -->
            <label class="mx-3">
              <input type="radio" name="condition" id="condition" value="1" required <?php if($isset_contact) if($contact['condition'] == 1) echo 'checked'; ?>>
              無事
            </label>
            <label>
              <input type="radio" name="condition" id="condition" value="0" <?php if($isset_contact) if($contact['condition'] == 0) echo 'checked'; ?>>
              有事
            </label>
          </div>

          <!-- 出社可否 -->
          <div class="mx-6 md:ml-24">
            <div class="font-bold mt-3 mb-1">出社可否</div>
            <!-- 可、不可チェック -->
            <label class="mx-3 mr-7"><input type="radio" name="isAttend" id="isAttend" value="1" required <?php if($isset_contact) if($contact['isAttend'] == 1) echo 'checked'; ?>>可</label>
            <label><input type="radio" name="isAttend" id="isAttend" value="0" <?php if($isset_contact) if($contact['isAttend'] == 0) echo 'checked'; ?>>不可</label>
          </div>

          <!-- 詳細情報 -->
          <div class="mx-6 md:mx-24">
            <div class="font-bold mt-3">詳細情報</div>
            <textarea name="detail" id="detail" class="w-full h-36 border p-2 border-black focus:outline-none"><?php if($isset_contact) echo $contact['detail'];?></textarea>
          </div>

          <!-- 投稿ボタン -->
          <div class="text-center">
            <button class="w-40 md:w-52 h-10 mt-3 bg-blue-400 font-bold text-white rounded" type="submit" name="btn_submit">投稿する</button>
          </div>  
        </form>
      </div>
    </div>  
  </main>
  <!-- メッセージ -->
  <?php
  if($message != ''):?>
  <div class='w-1/2 bg-blue-100 border border-blue-300 text-blue-600 px-4 py-3 rounded mx-auto text-center mt-5' role='alert'>
    <strong class='font-bold'><?=$message ?></strong>
  </div>
  <?php endif?>
</body>
</html>