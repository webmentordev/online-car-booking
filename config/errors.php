<?php if(count($errors) > 0): ?>
    <ul class="errors">
        <?php foreach($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>