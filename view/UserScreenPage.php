<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UtF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>user</title>
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
                <p class="text-lg absolute top-24 left-32 text-black"><span class="text-red-500">ログアウト</span>しますか?
                <input type="button" value="ログアウト" class="text-red-500 absolute bottom-14 right-56 cursor-pointer" onclick="location.href='MainScreen.html'">
                <label for="pop-up" class="text-black absolute bottom-14 right-24 cursor-pointer">キャンセル</label>  
                </div>
            </div>
            </div>
        </div>  
    </header>
    <main>
        <form action="users.php" method="POST">
            <div class="flex justify-center">
                <div class="w-full border border-gray-600 rounded-md mx-80 mt-10 pt-5 pb-2 px-20">
                    <h1 class=" text-sm md:text-4xl font-bold text-center">新規登録</h1>
                    <div class="mt-5">
                        <input type="number" name="user_id" placeholder="ID" class="w-full border-b border-black focus:outline-none" required>
                    </div>   
                    <div class="mt-3">
                        <input type="text" name="last_name" placeholder="姓" class="w-full mr-5 border-b border-black focus:outline-none" required>
                        <input type="text" name="first_name" placeholder="名" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3 text-gray-500">   
                        <label>部署</label>
                    </div>
                    <select name="section" id="section" class="w-14 md:w-28 py-1 pr-1  md:pl-4 text-gray-400 border border-gray-400 rounded">
                        <option value='' disabled selected style='display:none;'>部署選択</option>
                    </select>
                    <div class="mt-3">    
                        <input type="tel" name="phone_number" placeholder="電話番号" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="email" name="e_mail" placeholder="メールアドレス" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="email" name="e_mail2" placeholder="メールアドレス(再確認)" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="password" name="pw" id="pw" placeholder="パスワード" class="w-full border-b border-black focus:outline-none" required>
                    </div>
                    <div class="mt-3">    
                        <input type="password" name="pw2" id="pw2" placeholder="パスワード(再確認)" class="w-full border-b border-black focus:outline-none" required>
                    </div> 
                    <div class="text-center mt-5">   
                        <a id ="login" href="login.html">
                            <input type="submit" value="登録" class="w-60 h-10 bg-cyan-400 rounded-md text-white font-bold hover:cursor-pointer" required>
                        </a>
                    </div>
                    <div class="text-center mt-5 text-cyan-300">   
                        <a id="touroku" href="login.html">登録済みの方はこちら</a>
                    </div>   
                </div>
            </div> 
        </form>       
    </main>    
</body>  
</html>