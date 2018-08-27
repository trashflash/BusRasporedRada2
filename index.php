<?php
include('sidebar.php');

?>
<div style="padding-left:205px">
    <label class="w3-text-teal"><b>Autori ovog predivnog i funkcionalnog sajta su: </b> </label>
    <button class="w3-btn w3-blue-grey" id="btn">Pritisni gumb!</button>
    <div id="jsona"></div>
    <?php var_dump($_SESSION);?>
</div>
<script src="js/json.js"></script>