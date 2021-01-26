<?
   require 'functions.php';
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
      <div class="db_table" id="db_table">
         <div class="db_table__header">
            <h2>Таблицы</h2>
            <select onchange="if (this.value) window.location.href = this.value">
               <?
               if(empty($_GET['database'])){
                  echo '<option value="" selected disabled>Выберите один из база данных:</option>';
               }else{
                  echo '<option value="" disabled>Выберите один из база данных:</option>';
               }
                  $databases = array_diff(scandir("miniDB"), array('..', '.'));
                  if(count ($databases) > 0){
                     foreach ($databases as $db) {
                        $db = str_replace(".sql","",$db);
                        echo '<option value="?database='.$db.'"'; if($_GET['database'] == $db) echo ' selected'; echo '>'.$db.'</option>';
                     }
                  }
                  fclose($databases);
               ?>
            </select>
         </div>
         <?
         if(isset($_GET['database'])){
            echo '<div class="db_table__link">';
            $table_inside = file('miniDB/'.$_GET['database'].'.sql') or die("не удалось открыть файл");
            foreach ($table_inside as $value) {
               if (substr($value, 0, 6) !== "CREATE") continue;
               $value = str_replace('CREATE TABLE ', '', $value);
               $value = str_replace('`', '', $value);
               $value = str_replace('(', '', $value);
               $value = trim($value);
               echo '<a class="db_table__item btn" href="?database='.$_GET['database'].'&datatable='.$value.'#db_table">'.$value.'</a>';

            }
            echo '</div>';
            ?>
            <table class="table">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Тип машина</th>
                     <th>Цвет</th>
                     <th>Макс. скорость</th>
                     <th>Макс. скорость</th>
                  </tr>
               </thead>
               <tbody>
                  <?
                     $lines = file('miniDB/'.$_GET['database'].'.sql');
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

                     foreach ($lines as $line) {
                        echo '<tr>';
                        if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 1)  != '(') continue;
                        $line = str_replace("(", "", $line);
                        $line = str_replace(")", "", $line);
                        $line = str_replace(" ", "", $line);
                           $explode = explode(',', $line);
                           foreach($explode as $asd => $key){
                              $key = str_replace("'", "", $key);
                              $key = str_replace(";", "", $key);
                              echo '<td>'.$key.'</td>';
                           }
                        echo '</tr>';
                     }
                  ?>
               </tbody>
            </table>
         <?}else{?>
            <h3>База данных не выбрана. пожалуйста, выберите базу данных</h3>
         <?}?>

         
         <?if(isset($_GET['datatable'])){?>
            <hr>
            <div class="db_table__header">
               <h2>Форма добавления данные на базу данных</h2>
            </div>
            <form id="add-in-table">
               <table class="table not-border" id="add-to-tables-form">
                  <thead>
                     <tr>
                        <th>Имя поле</th>
                        <th>Значение</th>
                     </tr>
                  </thead>
                  <tbody>
                  <?
                     $table_inside2 = file('miniDB/'.$_GET['database'].'.sql');
                     foreach ($table_inside2 as $value) {
                        $value = trim($value);
                        if(substr($value, 0, 6) === 'CREATE'){
                           $table = str_replace('CREATE TABLE ','',$value);
                           $table = str_replace('`','',$table);
                           $table = str_replace('(','',$table);
                           $table = trim($table);
                        }
                        if (substr($value, 0, 1) !== "`" or $_GET['datatable'] !== $table) continue;
                        $value = strtok($value, '`');
                        echo '
                        <tr>
                           <td>'.$value.'</td>
                           <td><input type="text" name="'.$value.'"></td>
                        </tr>
                        ';
                     }
                  ?>
                  </tbody>
               </table>
               <input type="hidden" name="database" value="<?=$_GET['database']?>">
               <input type="hidden" name="datatable" value="<?=$_GET['datatable']?>">
               <div><input type="submit" value="Сохранить" class="btn"></div>
            </form>
         <?}?>
      </div>

      <div class="addtobase" id="addtobase">
         <div class="container">
            <h2>Форма добавления таблицы на базу данных</h2>
            <form id="addtobase_form">
               <table>
                  <tbody>
                     <tr>
                        <td>База данных:</td>
                        <td>
                           <select name="database" required>
                              <option value="" selected disabled>Выберите база данных</option>
                              <?
                              $files = array_diff(scandir("miniDB"), array('..', '.'));
                              foreach ($files as $db) {
                                 $db = str_replace(".sql","",$db);
                                 echo '<option value="'.$db.'">'.$db.'</option>';
                              }
                              fclose($files);
                              ?>
                           </select>
                        </td>
                        <td><a class="btn" id="add_db_btn" target=".add_db" style="padding:10px;max-width:300px;">Добавить новый баз данных</a></td>
                     </tr>
                  </tbody>
               </table>
               <table>
                  <tbody>
                     <tr>
                        <td>Имя таблицы:</td>
                        <td><input type="text" name="table_name" maxlength="64" value="" required=""></td>
                        <td><input class="btn submit_num_fields" type="button" name="submit_num_fields" value="Добавить поле"></td>
                     </tr>
                  </tbody>
               </table>
               <table class="addtobase__table" id="new-fields">
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
                        <td><input type="text" name="field_name[]"></td>
                        <td>
                           <select name="type[]">
                              <option value="INT">INT</option>
                              <option value="VARCHAR">VARCHAR</option>
                              <option value="TEXT">TEXT</option>
                           </select>
                        </td>
                        <td><input class="small" type="number" min="1" name="length[]"></td>
                        <td>
                           <select name="index[]">
                              <option value="PRIMARY">PRIMARY</option>
                              <option value="UNIQUE">UNIQUE</option>
                              <option value="INDEX">INDEX</option>
                              <option value="FULLTEXT">FULLTEXT</option>
                              <option value="SPATIAL">SPATIAL</option>
                           </select>
                        </td>
                        <td>
                           <input type="checkbox" name="ai[]">
                        </td>
                     </tr>
                     <tr>
                        <td><input type="text" name="field_name[]"></td>
                        <td>
                           <select name="type[]">
                              <option value="INT">INT</option>
                              <option value="VARCHAR">VARCHAR</option>
                              <option value="TEXT">TEXT</option>
                           </select>
                        </td>
                        <td><input class="small" type="number" min="1" name="length[]"></td>
                        <td>
                           <select name="index[]">
                              <option value="PRIMARY">PRIMARY</option>
                              <option value="UNIQUE">UNIQUE</option>
                              <option value="INDEX">INDEX</option>
                              <option value="FULLTEXT">FULLTEXT</option>
                              <option value="SPATIAL">SPATIAL</option>
                           </select>
                        </td>
                        <td>
                           <input type="checkbox" name="ai[]">
                        </td>
                     </tr>
                  </tbody>
               </table>  
               <table class="addtobase__table">
                  <tbody>
                     <tr>
                        <td><input type="text" name="comment" placeholder="Комментарии к таблице:"></td>
                        <td>
                           <select name="engine" required>
                              <option value="" disabled selected>Тип таблиц:</option>
                              <option value="csv" title="Stores tables as CSV files">CSV</option>
                              <option value="mrg_myisam" title="Collection of identical MyISAM tables">MRG_MyISAM</option>
                              <option value="memory" title="Hash based, stored in memory, useful for temporary tables">MEMORY</option>
                              <option value="myisam" title="Non-transactional engine with good performance and small data footprint">MyISAM</option>
                              <option value="sequence" title="Generated tables filled with sequential values">SEQUENCE</option>
                              <option value="innodb" title="Supports transactions, row-level locking, foreign keys and encryption for tables">InnoDB</option>
                              <option value="aria" title="Crash-safe tables with MyISAM heritage">Aria</option>
                           </select>
                        </td>
                        <td>
                           <input type="submit" class="btn" value="Сохранить">
                        </td>
                     </tr>
                  </tbody>
               </table> 
            </form>
         </div>
      </div>

   </main>
   <footer>
      
   </footer>
   <div class="modals" id="mm">
      <div class="item add_db">
         <div class="modals__header">
            <h2 class="modals__title">Добавить новый база данных</h2>
            <div class="modals__close" target=".add_db"></div>
         </div>
         <form id="add_db_form">
            <div class="modals__body">
               <label for="db_name">Имя нового базу данных:</label>
               <input type="text" name="db_name" id="db_name">
            </div>
            <div class="modals__footer">
               <input type="submit" class="btn" value="Добавить">
            </div>
         </form>
      </div>
   </div>
   <div id="output"></div>
   <script src="/node_modules/jquery/dist/jquery.min.js"></script>
   <!-- Owl-carousel -->
   <script src="/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>

   <script>
      $('.owl-carousel').owlCarousel({
         loop:true,
         nav:true,
         items:1,
         autoHeight: true,
      });

      $('#add_db_btn').click(function(){
         let thisid = $(this).attr('target');
         $('.modals').css("display", "flex");
         $(thisid).addClass("active");
      });
      
      $('.modals__close').click(function(){
         let thisid = $(this).attr('target');
         $('.modals').css("display", "none");
         $(thisid).removeClass("active");
      });

      $("#add_db_form").on('submit',(function(el) {
         el.preventDefault();
         $.ajax({
               url: 'actions/add_db.php',
               type: "POST",
               data:  new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
               success: function(data){
                  $("#output").html(data);
               }
         });
      }));
      $("#addtobase_form").on('submit',(function(el) {
         el.preventDefault();
         $.ajax({
               url: 'actions/add_table.php',
               type: "POST",
               data:  new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
               success: function(data){
                  $("#output").html(data);
               }
         });
      }));
      $("#add-in-table").on('submit',(function(el) {
         el.preventDefault();
         $.ajax({
               url: 'actions/add_in_table.php',
               type: "POST",
               data:  new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
               success: function(data){
                  $("#output").html(data);
               }
         });
      }));

      $(".submit_num_fields").on("click", function () {
         var newRow = $("<tr>");
         
         var cols = "";
         cols += '<td><input type="text" name="field_name[]"></td>';
         cols += '<td><select name="type[]"><option value="INT">INT</option><option value="VARCHAR">VARCHAR</option><option value="TEXT">TEXT</option></select></td>';
         cols += '<td><input class="small" type="number" min="1" name="length[]"></td>';
         cols += '<td><select name="index[]"><option value="PRIMARY">PRIMARY</option><option value="UNIQUE">UNIQUE</option><option value="INDEX">INDEX</option><option value="FULLTEXT">FULLTEXT</option><option value="SPATIAL">SPATIAL</option></select></td>';
         cols += '<td><input type="checkbox" name="ai[]"></td>';

         newRow.append(cols);
         $("#new-fields").append(newRow);
      });
   </script>
</body>
</html>