<?php
namespace PHPMaker2019\ferryman;
?>
<?php if ($category->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_categorymaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($category->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $category->TableLeftColumnClass ?>"><?php echo $category->name->caption() ?></td>
			<td<?php echo $category->name->cellAttributes() ?>>
<span id="el_category_name">
<span<?php echo $category->name->viewAttributes() ?>>
<?php echo $category->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($category->description->Visible) { // description ?>
		<tr id="r_description">
			<td class="<?php echo $category->TableLeftColumnClass ?>"><?php echo $category->description->caption() ?></td>
			<td<?php echo $category->description->cellAttributes() ?>>
<span id="el_category_description">
<span<?php echo $category->description->viewAttributes() ?>>
<?php echo $category->description->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
