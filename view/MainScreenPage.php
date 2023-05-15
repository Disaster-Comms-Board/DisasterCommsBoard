<?php
require_once '../functions/contact.php';
session_start();
$myRole = $_SESSION['role'];

// メッセージを保存するファイルのパス
define('FILENAME', '../message.txt');

$condition_num = getPeople();
$no_contact_num = getNoContact();

// 変数の初期化
$current_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();

if( $file_handle = fopen( FILENAME,'r') ) {
  while( $data = fgets($file_handle) ){
    $split_data = preg_split( '/\'/', $data);

        $message = array(
            'info' => $split_data[1],
            'post_date' => $split_data[3]
        );
        array_unshift( $message_array, $message);
  }
  // ファイルを閉じる
  fclose( $file_handle);
}

if(isset($_POST['btn_submit'])){
  if($file_handle = fopen(FILENAME, 'r+')){
    $current_date = date("Y-m-d H:i:s");
      $info = str_replace("\r\n", '', $_POST['info']);
      $data = "'" . $info ."','" . $current_date . "'";
      fwrite($file_handle, $data);

    // ファイルを閉じる
    fclose($file_handle);
  }
  header('refresh: 0');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>メイン画面</title>
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
    <!-- <link rel="stylesheet" href="../css/reset.css"> -->
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <main class=>
    <div class="flex justify-center ">  
      <div>
        <h2 class="text-3xl font-bold mt-4 mb-2 ">お知らせ</h2>
          <?php if(isset($message_array)): ?>
            <?php foreach($message_array as $value): ?>
              <h2 class="text-2xl text-center bg-slate-100 rounded-md p-4 w-full max-w-2xl"><?php echo $value['info']; ?></h2>
		          <div class="text-right">
                <small>更新：<time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time></small>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

          <?php if($myRole == 'Admin'): ?>
            <form action="" method="post" class="text-right">
              <textarea name="info" class="w-full h-16 md:h-22 border border-black rounded focus:outline-none mt-3 p-2"></textarea>
              <button type="submit" name="btn_submit" class="w-24 md:w-20 h-10 mt-3 bg-gray-400 font-bold text-white rounded">変更</button>
            </form>
            <hr class="mt-3">
          <?php endif; ?>

          <div class="flex justify-center text-left pl-5">
            <ul class="m-4"> 
              <?php foreach($condition as $con): ?>
              <li class="text-2xl font-bold m-2  border-black pl-2"><?=$con ?></li>
              <?php endforeach?>
              <li class="text-2xl font-bold m-2  border-black">未確認<li>
            </ul>
            <ul class="m-4"> 
              <?php foreach($condition_num as $num): ?>
              <li class="text-2xl font-bold m-2  border-black"><?=$num ?></li>
              <?php endforeach ?>
              <li class="text-2xl font-bold m-2  border-black"><?=$no_contact_num ?><li>
            </ul>
            <ul class="m-4"> 
              <?php foreach($condition_num as $num): ?>
                <li class="text-2xl font-bold m-2  border-black">人</li>
              <?php endforeach ?>
              <li class="text-2xl font-bold m-2  border-black">人<li>
            </ul>
          </div>
        <div class="flex justify-between font-bold text-2xl">
            <div class="relative">
              <a href="PostingScreenPage.php">
                <button class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 rounded-md cursor-pointer">
                  <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-14 cursor-pointer" >投稿</div>
                  <div class="absolute border-t-2 border-white pt-3 px-2 md:px-0 bottom-6 left-0 md:bottom-12 md:left-3 text-xs md:text-sm text-white cursor-pointer">安否確認の投稿はこちら</div>
                </button>
              </a>
            </div>  
            <div class="relative md:mx-16">
              <a href="FullDetailScreenPage.php">
                <button class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 mx-1 rounded-md cursor-pointer"> 
                  <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-16 cursor-pointer">詳細</div>
                  <div class="absolute border-t-2 border-white pt-3 px-2 md:px-0 bottom-6 left-1 md:bottom-12 md:left-4 text-xs md:text-sm text-white cursor-pointer">安否確認の詳細はこちら</div>
                </button>
              </a>
            </div>   
            <div class="relative">
              <a href="ProfilePage.php">
                <button type="button" class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 rounded-md cursor-pointer">
                  <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-14 cursor-pointer">編集</div>
                  <div class="absolute border-t-2 border-white pt-3 px-1 md:px-0 bottom-6 left-0 md:bottom-12 md:left-2 text-xs md:text-sm text-white cursor-pointer">プロフィールの編集はこちら</div>
                </button>
              </a>
            </div>  
        </div>
      </div> 
    </div> 
  </main>
</body>
</html>