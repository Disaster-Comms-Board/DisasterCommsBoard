<?
$roll = true;


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>全体詳細画面</title>
  </head>
  <body>
    <!-- ヘッダー -->
    <header>
      <div class="inline-flex items-center w-full h-16 bg-gray-600 text-white">
        <!-- ホームアイコン -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-5 ml-15 mr-10 cursor-pointer">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
        <h1 class ="md:text-4xl font-bold">
          災害時連絡掲示板
        </h1>
        <a class="flex cursor-pointer ml-auto mt-2">
          <!-- ログアウトアイコン -->
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-8 h-8 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
          </svg>
          <p class="text-right mr-5 mt-1 font-bold">ログアウト</p>
        </a>
      </div>  
    </header>
    <!-- メイン -->
    <main class="mx-5">
      <!-- 検索欄 -->
      <div class="inline-flex items-center">
        <input type="search" name="search" placeholder="Search" class="md:ml-20 mr-10  pl-1 w-full h-8 border border-black rounded-lg  focus:outline-none " style="color: grey">
        <div>
          <select name="course" id="course" class="w-full py-2 pl-4 my-5 mr-20 border border-black rounded">
            <option class="p-6 " value="">

            </option>
          </select>
        </div>
        <div class="ml-5">
          <select name="course" id="course" class="w-full py-2 pl-4 my-5 mr-20 border border-black rounded">
            <option class="p-6" value="">
            </option>
          </select>
        </div>
      </div>  

      <!-- 一覧表示テーブル -->
      <div>
        <table class="w-full">
          <thead class="bg-green-200">
            <tr>
              <th class="border border-solid border-gray-500">ID</th>
              <th class="border border-solid border-gray-500">氏名</th>
              <th class="border border-solid border-gray-500">店舗</th>
              <th class="border border-solid border-gray-500">連絡</th>
              <th class="border border-solid border-gray-500">安否</th>
              <th class="border border-solid border-gray-500">出社</th>
              <!-- アルバイト側の画面では表示しないようにする -->
              <th class="border border-solid border-gray-500"></th>        
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="border border-solid border-gray-500 font-bold h-14 hover:bg-yellow-50">
              <td class="border border-solid border-gray-500">0000001</td>
              <td class="border border-solid border-gray-500">ECC太郎</td>
              <td class="border border-solid border-gray-500">梅田駅前店</td>
              <td class="border border-solid border-gray-500">有</td>
              <td class="border border-solid border-gray-500">無事</td>
              <td class="border border-solid border-gray-500">可</td>
              <!-- アルバイト側画面では表示しないようにする -->
              <td class="border border-solid border-gray-500">
                <!-- 個人詳細画面に遷移 -->
                <a href="./PersonalDetailScreen.html" class="cursor-pointer text-blue-500">詳細画面へ</a>
              </td>
            </tr>
          </tbody>
          <tbody class="text-center">
            <tr class="border border-solid border-gray-500 font-bold h-14 hover:bg-yellow-50">
              <td class="border border-solid border-gray-500">0000001</td>
              <td class="border border-solid border-gray-500">ECC太郎</td>
              <td class="border border-solid border-gray-500">梅田駅前店</td>
              <td class="border border-solid border-gray-500">有</td>
              <td class="border border-solid border-gray-500">無事</td>
              <td class="border border-solid border-gray-500">可</td>
              <!-- アルバイト側画面では表示しないようにする -->
              <td class="border border-solid border-gray-500">
                <!-- 個人詳細画面に遷移 -->
                <a href="./PersonalDetailScreen.html" class="cursor-pointer">詳細画面へ</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div> 
    </main>
  </body>
</html>
