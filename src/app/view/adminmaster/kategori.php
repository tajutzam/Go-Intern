<?php

use LearnPhpMvc\Config\Url;
?>
<div class="content-wrapper container">
    <form action="<?=Url::BaseUrl()."/admin/kategori/add"?>" method="post">
        <input type="text" name="kategori">
        <button type="submit">Submit</button>
    </form>
</div>