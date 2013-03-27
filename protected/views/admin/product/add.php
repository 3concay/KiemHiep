<?php
$this->breadcrumbs = array("Sàn Phẩm","Thêm Mới");
?>
<h2 class="pageTitle">Thêm Mới Sản Phẩm</h2>
<?php
$this->renderPartial("product/_form",array('model'=>$model));
?>