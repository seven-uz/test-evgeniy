<?

require '../functions.php';

if(isset($_POST['db_name'])){
   $db_dir = '../miniDB/';

   $filename = $_POST['db_name'].'.sql';
   if(!file_exists($db_dir.$filename)){
      $fd = fopen($db_dir.$filename, 'a+') or die("не удалось создать файл");
      $str = "--\n-- База данных: `".$_POST['db_name']."`\n--";
      $write = fwrite($fd, $str);
      fclose($fd);

      if($write){
         echo toast('success', 'Все хорошо, спасибо вам ))');
         ?><script>setTimeout("window.location.reload()",2000);</script><?
      }
   }else{
      echo toast('error', 'Извини, но есть база под названием <strong><u>'.$_POST['db_name'].'</u></strong>');
   }
   ?><script>
      $('.toast-close-button').click(function(){
         $('#toast-container').css('display','none')
      });
   </script><?
}