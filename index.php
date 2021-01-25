<?

if(isset($_POST['table_name'])){
   $filename = 'tables.sql';
   $fd = fopen($filename, 'a+') or die("не удалось создать файл");
   $str = "CREATE TABLE `yangibaza`.`".$_POST['table_name']."` (
   `id` int(11) NOT NULL,
   `ordno` int(11) NOT NULL,
   `kvmot` decimal(15,2) NOT NULL,
   `kuni` date NOT NULL,
   `status` tinyint(3) NOT NULL
) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

";
   fwrite($fd, $str);
   fclose($fd);
   // CREATE TABLE IF NOT EXIST `yangibaza`.`haha` ( `id` TEXT NOT NULL AUTO_INCREMENT , `login` INT NOT NULL , `password` VARCHAR(250) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

   // INSERT INTO `yangibaza`.`321`
   // (`id`, `ordno`, `kvmot`, `kuni`, `status`) VALUES 
   // (1,2131,5,2020-05-10,0),
   // (1,2131,5,2020-05-10,0),
   // (1,2131,5,2020-05-10,0),
   // (1,2131,5,2020-05-10,0);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Тестовое задание для Евгений Манацкий</title>
   <meta name="description" content="Тестовое задание для Евгений Манацкий">
   <meta name="keywords" content="test, тест, задания, тестовое задание">
   <link rel="stylesheet" href="assets/css/styles.min.css">
</head>
<body>
   <header class="header" id="home">
      <nav class="header__menu">
         <div class="header__logo">
            <a href="/">Тестовое задание</a>
         </div>
         <div class="header__link">
            <a href="#home">Главная</a>
            <a href="#db_table">Таблица баз данных</a>
            <a href="#addtobase">Добавить на базу</a>
         </div>
      </nav>
      <div class="carousel">
         <div class="owl-carousel">
            <div class="item">
               <h2>Зоголовок 1</h2>
               <p>Lorem ipsum dolor sit, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae accusamus, ad sit, repellat quo architecto consequuntur animi, dolorum laborum laudantium possimus. Deleniti consectetur corporis quas, dolorem pariatur maiores provident unde aliquam earum nihil, perferendis ipsam necessitatibus ab recusandae, facere fugit. amet consectetur adipisicing elit. Voluptatum ea quaerat ipsam, voluptas et deserunt sit cumque ullam facilis commodi!</p>
               <a class="btn" href="#">Читать больше</a>
            </div>
            <div class="item">
               <h2>Зоголовок 2</h2>
               <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatum ea quaerat ipsam, voluptas et deserunt sit cumque ullam facilis commodi!</p>
               <a class="btn" href="#">Читать больше</a>
            </div>
            <div class="item">
               <h2>Зоголовок 3</h2>
               <p>Lorem ipsum dolor Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum amet fugit atque ipsa mollitia vero, ullam, quisquam ipsum sunt nulla recusandae. Reiciendis, mollitia consequuntur labore, distinctio in eveniet esse optio quas eligendi expedita ad numquam commodi dolorum dicta deleniti, eos architecto. Fuga ipsam praesentium neque autem repellendus. Assumenda, consequatur facilis, aliquid vel libero dicta placeat modi saepe enim accusantium unde, rerum ipsum fugit quis. Adipisci odit eaque nemo temporibus suscipit sapiente eligendi obcaecati corrupti culpa fugit voluptate consectetur eius perferendis iste, est dolore ea beatae quos doloribus sequi vitae facilis inventore. Facere modi laboriosam minima! Deserunt consectetur sed necessitatibus perspiciatis. sit, amet consectetur adipisicing elit. Voluptatum ea quaerat ipsam, voluptas et deserunt sit cumque ullam facilis commodi!</p>
               <a class="btn" href="#">Читать больше</a>
            </div>
         </div>
      </div>
   </header>
   <main>
      <div class="info" id="info">
         
      </div>

      <div class="statistics" id="statistics">
         <div class="info__item">
            <h4>Lorem, ipsum.</h4>
            <p>245</p>
         </div>
         <div class="info__item">
            <h4>Lorem, ipsum.</h4>
            <p>32</p>
         </div>
         <div class="info__item">
            <h4>Lorem, ipsum.</h4>
            <p>123</p>
         </div>
         <div class="info__item">
            <h4>Lorem, ipsum.</h4>
            <p>54</p>
         </div>
      </div>

      <div class="db_table" id="db_table">
         <table class="table">
            <thead>
               <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
      <?
         $lines = file('rows-in-tables.sql');
         $lines2 = file_get_contents('rows-in-tables.sql');
         $lines2 = preg_split("~\\n(?=\\s+)~",$lines2);
         $lines2r = preg_grep("~Дамп данных~ui",$lines2);

         function get_string_between($string, $start, $end){
            $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
         }

         $parsed = get_string_between($lines2, '`', '`');
         print_r($lines2);

         foreach ($lines as $line) {
            echo '<tr>';
            if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1)  != '(') continue;
            $line = str_replace("(", "", $line);
            $line = str_replace(")", "", $line);
            // if (substr(trim($line), 1) == '(') {
               $explode = explode(',', $line);
               foreach($explode as $asd => $key){
                  echo 
                     '<td>'.$key.'</td>';
                  }
                  echo '</tr>';
            // }
         }
      ?>
         
               
            </tbody>
         </table>
      </div>

      <div class="addtobase" id="addtobase">
         <form action="#" method="post" class="addtobase__form">
            <table>
               <tbody>
                  <tr>
                     <td>База данных:</td>
                     <td>
                        <select name="db_list" required>
                           <option value="" selected disabled>Выберите база данных</option>
                           <?
                           $fd = file("bases.txt") or die("не удалось открыть файл");
                           foreach ($fd as $lines) {
                              echo '<option value="'.$lines.'">'.$lines.'</option>';
                           }
                           fclose($fd);
                           ?>
                        </select>
                     </td>
                     <td><a class="btn" id="add_db_btn" style="padding:10px;max-width:300px;">Добавить новый баз данных</a></td>
                  </tr>
               </tbody>
            </table>
            <table>
               <tbody>
                  <tr>
                     <td>Имя таблицы:</td>
                     <td><input type="text" name="table_name" maxlength="64" value="" autofocus="" required=""></td>
                     <td align="right">Добавить</td>
                     <td align="center"><input type="number" name="added_fields" value="1" min="1" onfocus="this.select()"></td>
                     <td>поле(я)</td>
                     <td><input class="btn" type="button" name="submit_num_fields" value="Вперёд"></td>
                  </tr>
               </tbody>
            </table>
            <hr>
            <table class="addtobase__table">
               <thead>
                  <tr>
                     <th>Имя</th>
                     <th>Тип</th>
                     <th>Длина/Значения</th>
                     <th>Индекс</th>
                     <th>A_I</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><input type="text"></td>
                     <td>
                        <select name="type">
                           <option value="int">INT</option>
                           <option value="varchar">VARCHAR</option>
                           <option value="text">TEXT</option>
                        </select>
                     </td>
                     <td><input class="small" type="number"></td>
                     <td>
                        <select name="21321">
                           <option value="primary">primary</option>
                           <option value="unique">unique</option>
                           <option value="index">index</option>
                           <option value="fulltext">fulltext</option>
                           <option value="spatial">spatial</option>
                        </select>
                     </td>
                     <td>
                        <input type="checkbox" name="ai">
                     </td>
                  </tr>
                  <tr>
                     <td><input type="text"></td>
                     <td>
                        <select name="type">
                           <option value="int">INT</option>
                           <option value="varchar">VARCHAR</option>
                           <option value="text">TEXT</option>
                        </select>
                     </td>
                     <td><input class="small" type="number"></td>
                     <td>
                        <select name="21321">
                           <option value="primary">primary</option>
                           <option value="unique">unique</option>
                           <option value="index">index</option>
                           <option value="fulltext">fulltext</option>
                           <option value="spatial">spatial</option>
                        </select>
                     </td>
                     <td>
                        <input type="checkbox" name="ai">
                     </td>
                  </tr>
                  <tr>
                     <td><input type="text"></td>
                     <td>
                        <select name="type">
                           <option value="int">INT</option>
                           <option value="varchar">VARCHAR</option>
                           <option value="text">TEXT</option>
                        </select>
                     </td>
                     <td><input class="small" type="number"></td>
                     <td>
                        <select name="21321">
                           <option value="primary">primary</option>
                           <option value="unique">unique</option>
                           <option value="index">index</option>
                           <option value="fulltext">fulltext</option>
                           <option value="spatial">spatial</option>
                        </select>
                     </td>
                     <td>
                        <input type="checkbox" name="ai">
                     </td>
                  </tr>
                  <tr>
                     <td><input type="text"></td>
                     <td>
                        <select name="type">
                           <option value="int">INT</option>
                           <option value="varchar">VARCHAR</option>
                           <option value="text">TEXT</option>
                        </select>
                     </td>
                     <td><input class="small" type="number"></td>
                     <td>
                        <select name="21321">
                           <option value="primary">primary</option>
                           <option value="unique">unique</option>
                           <option value="index">index</option>
                           <option value="fulltext">fulltext</option>
                           <option value="spatial">spatial</option>
                        </select>
                     </td>
                     <td>
                        <input type="checkbox" name="ai">
                     </td>
                  </tr>
               </tbody>
            </table>  
            <hr>
            <table class="addtobase__table">
               <tbody>
                  <tr>
                     <td><input type="text" name="comment"></td>
                     <td>
                        <select name="type_table">
                           <option value="csv">CSV</option>
                           <option value="mrg_myisam">MRG_MyISAM</option>
                           <option value="memory">MEMORY</option>
                           <option value="myisam">MyISAM</option>
                           <option value="sequence">SEQUENCE</option>
                           <option value="innodb">InnoDB</option>
                           <option value="aria">Aria</option>
                        </select>
                     </td>
                     <td>
                        <input type="submit" class="btn" value="Сохранить">
                     </td>
                  </tr>
               </tbody>
            </table> 
         </form>
         <?php
$tables = 'testbase-tables.sql';


      // $mysql_host = 'localhost';
      // $mysql_username = 'root';
      // $mysql_password = '';
      // $mysql_database = 'yangibaza';

      // $dd = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database) or die('Error connecting to MySQL server: ' . mysql_error());

      // $templine = '';
      // $lines = file($filename);
      // foreach ($lines as $line) {
      //    if (substr($line, 0, 2) == '--' || $line == '') continue;

      //    $templine .= $line;
      //    if (substr(trim($line), -1, 1) == ';') {
      //    $mys = mysqli_query($dd, $templine);
      //    echo $templine.'<br>';
      //    $templine = '';
      //    }
      // }

         ?>
      </div>

   </main>
   <script src="/node_modules/jquery/dist/jquery.min.js"></script>
   <!-- Owl-carousel -->
   <script src="/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>

   <script>
      $('.owl-carousel').owlCarousel({
         loop:true,
         nav:true,
         items:1,
         autoHeight: true,
      })
   </script>
</body>
</html>