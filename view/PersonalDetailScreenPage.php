<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>個人詳細画面</title>
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
    <div class="flex justify-center mt-5">
      <ul class="font-bold">
        <li class="md:text-2xl">ユーザー情報</li>
        <li class="md:text-lg pl-2 mt-3">ID</li>
        <li class="md:text-lg mt-3">氏名</li>
        <li class="md:text-lg mt-3">勤務店舗</li>
        <li class="md:text-lg mt-3">役職</li>
        <li class="md:text-lg mt-3">電話番号</li>
        <li class="md:text-lg mt-3">メールアドレス</li>
        <li class="md:text-lg mt-3">安否</li>   
        <li class="md:text-lg mt-3">出社</li>
        <li class="md:text-lg mt-3">詳細情報</li>            
      </ul>
      <ul class="ml-5">
        <li class="md:text-lg mt-11">0000001</li>
        <li class="md:text-lg mt-3">ECC太郎</li>
        <li class="md:text-lg mt-3">梅田駅前店</li>
        <li class="md:text-lg mt-3">マネージャー</li>
        <li class="md:text-lg mt-3">xxx-xxx-xxxx</li>
        <li class="md:text-lg mt-3">eccstudent@ecc.ac.jp</li>
        <li class="md:text-lg mt-3">無事</li>
        <li class="md:text-lg mt-3">可能</li>
      </ul>
    </div>
    <div class="flex justify-center md:ml-20">
      <textarea name="message" class="w-64 md:w-96 h-32 md:h-44 my-3 border border-black rounded focus:outline-none" disabled>
      </textarea>
    </div>  
  </main>
</body>
</html>