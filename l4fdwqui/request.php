<?php
include_once "../l1comvm/vmlayer.php";

//L4FHYS的入口起点
//这里的入参格式是跟前端界面商量约定好的
if (isset($_GET["action"])){
    require("../l1mainentry/h5ui_entry_fdwq.php");
}

?>