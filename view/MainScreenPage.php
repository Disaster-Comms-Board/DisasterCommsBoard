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
</head>
<body>
  <?php
  include 'header.php';
  ?>
  <main class=>
    <div class="flex justify-center ">  
      <div>
        <h2 class="text-3xl font-bold mt-4 mb-2 ">お知らせ</h2>
          <textarea name="info" class="w-full h-32 md:h-44 border border-black rounded focus:outline-none "></textarea>
          <div class="flex justify-center text-left pl-5">
            <ul class="m-4"> 
              <li class="text-2xl font-bold m-2  border-black pl-2">無事</li>
              <li class="text-2xl font-bold m-2  border-black pl-2">有事</li>
              <li class="text-2xl font-bold m-2  border-black">未確認<li>
            </ul>
            <ul class="m-4"> 
              <li class="text-2xl font-bold m-2  border-black">1</li>
              <li class="text-2xl font-bold m-2  border-black">2</li>
              <li class="text-2xl font-bold m-2  border-black">3<li>
            </ul>
            <ul class="m-4"> 
              <li class="text-2xl font-bold m-2  border-black">人</li>
              <li class="text-2xl font-bold m-2  border-black">人</li>
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