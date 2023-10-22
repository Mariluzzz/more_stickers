<?php

session_start();

    if($_SESSION['sessaoAdmin']) {
        ?>
            <input type="hidden" id="adm" value="1"></input>
        <?php
    } else {
        ?>
            <input type="hidden" id="adm" value="0"></input>
        <?php
    }
?>