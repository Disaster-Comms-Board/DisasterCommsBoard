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