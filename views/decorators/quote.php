<?php 

?>
<div class="quote">
   <blockquote>
      <p>&ldquo;<?= $content ?>&rdquo;</p>
      <?php if(!empty($author)): ?>
         <footer><?= $author ?></footer>
      <?php endif; ?>
   </blockquote>
   
</div>
