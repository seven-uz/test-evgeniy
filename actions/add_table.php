<?

require '../functions.php';

if(isset($_POST['database'])){
   $db_dir = '../miniDB/';

   $filename = $_POST['database'].'.sql';
   
   $fd = fopen($db_dir.$filename, 'a+') or die("не удалось создать файл");
   $str = "\n\n-- ---------------------------\n\n--\n-- Структура таблицы `".$_POST['table_name']."`\n--\n\n";
   $str .= "CREATE TABLE `".$_POST['table_name']."` (";
   foreach($_POST['field_name'] as $key => $value) {
      $type = $_POST['type'][$key];
      $length = $_POST['length'][$key];

      if(empty($length) and $type === 'INT') $length = '11'; else $length = $_POST['length'][$key];

      if(empty($length) && $type === 'VARCHAR'){
         echo toast('error','Значения "VARCHAR" не может быт пустыми');
         exit;
      }

$str .= "
   `".$value."` ".$type."(".$length.") NOT NULL,";
   if(empty($value)) continue;
   }
   $str = substr($str, 0, -1);
   $str .= "\n) ENGINE=".$_POST['engine']." DEFAULT CHARSET=utf8;";
   $write = fwrite($fd, $str);
   fclose($fd);

   if($write){
      echo toast('success', 'Все хорошо, спасибо вам ))');
      ?><script>//setTimeout("window.location.reload()",2000);</script><?
   }
   // else{
   //    echo toast('error', 'Извини, но есть база под названием <strong><u>'.$_POST['db_name'].'</u></strong>');
   // }
   ?><script>
      $('.toast-close-button').click(function(){
         $('#toast-container').css('display','none')
      });
   </script><?
}