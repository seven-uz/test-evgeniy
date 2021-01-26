<?

function toast($type, $text){
   return '
   <div id="toast-container" class="toast-top-full-width">
      <div class="toast toast-'.$type.'" aria-live="polite">
         <div class="toast-message">'.$text.'</div>
         <button type="button" class="toast-close-button" role="button">×</button>
      </div>
   </div>
   ';
}