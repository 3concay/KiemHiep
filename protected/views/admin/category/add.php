<?php
$this->breadcrumbs = array("Danh Mục","Thêm Mới");
?>
<h2 class="pageTitle">Thêm Mới Danh Mục</h2>
<?php
$this->renderPartial("category/_form",array('model'=>$model));
?>