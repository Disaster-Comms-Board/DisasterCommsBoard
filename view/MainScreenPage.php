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
  <header>
    <div class="inline-flex items-center w-full h-16 bg-gray-200 text-gray-800">
      <!-- ホームアイコン -->
      <a href="MainScreen.html">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 md:w-10 md:h-10 mx-3 mt-2 md:mt-0 md:mx-5 md:ml-15 md:mr-10 cursor-pointer">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
      </a>  
      <h1 class ="text-xl md:text-4xl font-bold mt-2 md:mt-0">
        災害時連絡掲示板
      </h1>
      <div class="flex ml-auto mt-2">
        <!-- ログアウトアイコン -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mt-3 md:mt-0 w-5 h-5 md:w-8 md:h-8">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
        </svg>
        <label class="text-sm md:text-xl text-right mr-5 mt-3 md:mt-1 font-bold cursor-pointer" for="pop-up">ログアウト</label>
        <input type="checkbox" id="pop-up">
        <div class="overlay">
          <div class="w-64 md:w-96 max-w-sm h-40 md:h-60 bg-white rounded-md flex justify-center items-center fixed top-2/4 left-2/4 -translate-x-2/4 -translate-y-2/4 ">
            <p class="text-lg absolute top-24 left-32 text-black"><span class="text-red-500">ログアウト</span>しますか?</p>
            <input type="button" value="ログアウト" class="text-red-500 absolute bottom-14 right-56 cursor-pointer" onclick="location.href='MainScreen.html'">
            <label for="pop-up" class="text-black absolute bottom-14 right-24 cursor-pointer">キャンセル</label>  
          </div>
        </div>
      </div>
    </div>  
  </header>
  <main class="bg-">
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
            <div class="relative" onclick="location.href =''">
              <input type="button" class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 rounded-md hover:bg-a hover:text-3xl cursor-pointer">
              <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-14 cursor-pointer" >投稿</div>
              <div class="absolute border-t-2 border-white pt-3 px-2 md:px-0 bottom-6 left-0 md:bottom-12 md:left-3 text-xs md:text-sm text-white cursor-pointer">安否確認の投稿はこちら</div>
            </div>  
            <div class="relative md:mx-16" onclick="location.href ='FullDetailScreen.html'">
              <input type="button" class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 mx-1 rounded-md hover:bg-a hover:text-3xl cursor-pointer"> 
              <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-16 cursor-pointer">詳細</div>
              <div class="absolute border-t-2 border-white pt-3 px-2 md:px-0 bottom-6 left-1 md:bottom-12 md:left-4 text-xs md:text-sm text-white cursor-pointer">安否確認の詳細はこちら</div>
            </div>   
            <div class="relative" onclick="location.href =''">
              <input type="button" class="text-white bg-blue-500 h-28 w-28 md:h-40 md:w-40 rounded-md cursor-pointer hover:bg-a hover:text-3xl">
              <div class="text-white font-bold absolute bottom-20 left-9 md:bottom-24 md:left-14 cursor-pointer">編集</div>
              <div class="absolute border-t-2 border-white pt-3 px-1 md:px-0 bottom-6 left-0 md:bottom-12 md:left-2 text-xs md:text-sm text-white cursor-pointer">プロフィールの編集はこちら</div>
            </div>  
        </div>
      </div> 
    </div> 
  </main>
</body>
</html>