<?php
$this->breadcrumbs = array("Danh Mục","Cập Nhật");
?>
<h2 class="pageTitle">Cập Nhật Danh Mục</h2>
<?php
$this->renderPartial("product/_form",array('model'=>$model));
?>