<?

require '../functions.php';

if(isset($_POST['database']) && isset($_POST['datatable'])){
   $db_dir = '../miniDB/';

   $filename = $_POST['database'].'.sql';
   
   $fd = fopen($db_dir.$filename, 'a+') or die("не удалось создать файл");
   // $str = "\n\n-- ---------------------------\n\n--\n-- Дамп данных таблицы `".$_POST['datatable']."`\n--\n\n";
   $str .= "\nINSERT INTO `".$_POST['datatable']."` (";
   
   foreach($_POST as $key => $value) {
      if($key === 'database') continue;
      if($key === 'datatable') continue;
      $str .= '`'.$key.'`,';
   }
   $str = substr($str, 0, -1);
   $str .= ') VALUES (';

   foreach($_POST as $key => $value) {
      if($key === 'database') continue;
      if($key === 'datatable') continue;
      $str .= '`'.$_POST[$key].'`,';
      
   }
   $str = substr($str, 0, -1).');';

   echo $str;
   $write = fwrite($fd, $str);
   fclose($fd);

   if($write){
      echo toast('success', 'Все хорошо, спасибо вам ))');
      ?><script>//setTimeout("window.location.reload()",2000);</script><?
   }
   ?><script>
      $('.toast-close-button').click(function(){
         $('#toast-container').css('display','none')
      });
   </script><?
}