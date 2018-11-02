<?php
namespace PHPMaker2019\ferryman;
?>
<?php if ($image->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_imagemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($image->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->name->caption() ?></td>
			<td<?php echo $image->name->cellAttributes() ?>>
<span id="el_image_name">
<span<?php echo $image->name->viewAttributes() ?>>
<?php echo $image->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->_userid->Visible) { // userid ?>
		<tr id="r__userid">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->_userid->caption() ?></td>
			<td<?php echo $image->_userid->cellAttributes() ?>>
<span id="el_image__userid">
<span<?php echo $image->_userid->viewAttributes() ?>>
<?php echo $image->_userid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->path->Visible) { // path ?>
		<tr id="r_path">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->path->caption() ?></td>
			<td<?php echo $image->path->cellAttributes() ?>>
<span id="el_image_path">
<span>
<?php echo GetFileViewTag($image->path, $image->path->getViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->description->Visible) { // description ?>
		<tr id="r_description">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->description->caption() ?></td>
			<td<?php echo $image->description->cellAttributes() ?>>
<span id="el_image_description">
<span<?php echo $image->description->viewAttributes() ?>>
<?php echo $image->description->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
