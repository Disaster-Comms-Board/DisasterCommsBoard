<?php
    include '../functions/users.php';

    $error = '';
    $message = '';
    if(isset($_POST['btn_submit'])){
        if(login()){
            $message = '編集完了しました';
            // メインページへ
            header("location: MainScreenPage.php");
        } else {
            $error = 'IDかパスワードが間違えています';
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UtF-8">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>login</title> 
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
     
    <body >
        <main>
            <form action="" method="POST">
                <div class="flex justify-center">
                    <div class="w-full border border-gray-600 rounded-md mx-80 mt-10 pt-10 pb-10 px-20">
                        <h1 class=" text-sm md:text-4xl font-bold text-center">ログイン</h1>
                        <div class="mt-20">
                            <input type="number" name="user_id" placeholder="ID" class="w-full border-b border-black focus:outline-none" required>
                        </div>   
                        <div class="mt-20">    
                            <input type="password" name="password" id="pw" placeholder="パスワード" class="w-full border-b border-black focus:outline-none" required>
                        </div>
                        <div class="flex justify-center mt-10">    
                            <input type="checkbox" name="checkbox" class="w-5 border-b border-black focus:outline-none">
                            <label class="ml-3">ログイン状態を保持する</label>
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" name="btn_submit" class="w-60 h-10 bg-cyan-400 rounded-md text-white font-bold hover:cursor-pointer">ログイン</button>
                        </div>
                        <div class="text-center mt-10 text-cyan-300">   
                            <a id="touroku" href="UserScreenPage.php">新規登録はこちら</a>
                        </div>   
                    </div>
                </div> 
            </form>  
            
            <?php
            if($error != ''): ?>
                <div class='w-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-auto text-center mt-5' role='alert'>
                    <strong class='font-bold'><?=$error ?></strong><br>
                    <span class='block sm:inline'>もう一度入力してください</span>
                </div>
            <?php endif ?>
            <?php
            if($message != ''): ?>
                <div class='w-1/2 bg-blue-100 border border-blue-400 text-red-700 px-4 py-3 rounded mx-auto text-center mt-5' role='alert'>
                    <strong class='font-bold'><?=$message ?></strong>
                </div>
            <?php endif ?>

        </main>    
    </body>  
</html>


