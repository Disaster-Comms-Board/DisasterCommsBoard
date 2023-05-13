<?php
require_once '../functions/users.php';
require_once '../functions/getInfo.php';

session_start();

$user = getUser($_SESSION['user_id'])[0];

$message = '';
if(isset($_POST['btn_submit'])){
    if(checkPW($_SESSION['user_id'], $_POST['password'])){
        updateUser();
        header("Location: MainScreenPage.php");
    } else {
        $message = 'パスワードが間違えています';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UtF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>プロフィール</title>
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
    <main>
        <form action="" method="POST">
            <div class="flex justify-center">
                <div class="w-full border border-gray-600 rounded-md mx-80 mt-10 pt-5 pb-2 px-20">
                    <h1 class=" text-sm md:text-4xl font-bold text-center">編集</h1>
                    <div class="mt-5">
                        <input type="number" name="user_id" value="<?=$user['user_id'] ?>" placeholder="ID" class="w-full border-b border-black focus:outline-none" readonly>
                    </div>   
                    <div class="mt-3">
                        <input type="text" name="last_name" value="<?=$user['last_name'] ?>" placeholder="姓" class="w-full mr-5 border-b border-black focus:outline-none" required>
                        <input type="text" name="first_name" value="<?=$user['first_name'] ?>" placeholder="名" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="flex">
                        <div class="flex-initial me-5">
                            <div class="mt-3 text-gray-500">   
                                <label>部署</label>
                            </div>
                            <select name="section_id" id="section" class="w-14 md:w-28 py-1 pr-1  md:pl-4 text-gray-400 border border-gray-400 rounded">
                                <option value='' disabled selected style='display:none;'>部署選択</option>
                                <?php foreach(getSections() as $section):?>
                                    <option value="<?=$section['section_id']?>" <?php if($section['section_id'] == $user['section_id']) echo 'selected' ?>><?=$section['section_name']?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="flex-initial">
                            <div class="mt-3 text-gray-500">   
                                <label>店舗</label>
                            </div>
                            <select name="store_id" id="store_id" class="w-14 md:w-28 py-1 pr-1  md:pl-4 text-gray-400 border border-gray-400 rounded">
                                <option value="" disables selected>店舗選択</option>
                                <?php foreach(getStores() as $store):?>
                                    <option value="<?=$store['store_id']?>" <?php if($store['store_id'] == $user['store_id']) echo 'selected' ?>><?=$store['store_name']?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">    
                        <input type="tel" name="phone_number" value="<?=$user['phone_number'] ?>" placeholder="電話番号" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="email" name="e_mail" value="<?=$user['e_mail'] ?>" placeholder="メールアドレス" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="password" name="password" id="pw" placeholder="パスワード" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="password" name="confirm_password" id="pw2" placeholder="パスワード(再確認)" class="w-full border-b border-black focus:outline-none" required>
                    </div> 
                    <div class="text-center mt-5">   
                        <button type="submit" name="btn_submit" class="w-60 h-10 bg-cyan-400 rounded-md text-white font-bold hover:cursor-pointer mb-4">送信</button>
                    </div>
                </div>
            </div> 
        </form> 
    </main>    
    <!-- メッセージ -->
    <?php
    if($message != ''): ?>
        <div class='w-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-auto text-center mt-5' role='alert'>
            <strong class='font-bold'><?=$message ?></strong><br>
            <span class='block sm:inline'>もう一度入力してください</span>
        </div>
    <?php endif ?>
</body>  
</html>