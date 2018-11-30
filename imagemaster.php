<?php
namespace PHPMaker2019\ferryman;
?>
<?php if ($image->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_imagemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
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
<?php if ($image->uuid->Visible) { // uuid ?>
		<tr id="r_uuid">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->uuid->caption() ?></td>
			<td<?php echo $image->uuid->cellAttributes() ?>>
<span id="el_image_uuid">
<span<?php echo $image->uuid->viewAttributes() ?>>
<?php echo $image->uuid->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->user_id->Visible) { // user_id ?>
		<tr id="r_user_id">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->user_id->caption() ?></td>
			<td<?php echo $image->user_id->cellAttributes() ?>>
<span id="el_image_user_id">
<span<?php echo $image->user_id->viewAttributes() ?>>
<?php echo $image->user_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->confirmed->Visible) { // confirmed ?>
		<tr id="r_confirmed">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->confirmed->caption() ?></td>
			<td<?php echo $image->confirmed->cellAttributes() ?>>
<span id="el_image_confirmed">
<span<?php echo $image->confirmed->viewAttributes() ?>>
<?php echo $image->confirmed->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->createdAt->Visible) { // createdAt ?>
		<tr id="r_createdAt">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->createdAt->caption() ?></td>
			<td<?php echo $image->createdAt->cellAttributes() ?>>
<span id="el_image_createdAt">
<span<?php echo $image->createdAt->viewAttributes() ?>>
<?php echo $image->createdAt->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($image->updatedAt->Visible) { // updatedAt ?>
		<tr id="r_updatedAt">
			<td class="<?php echo $image->TableLeftColumnClass ?>"><?php echo $image->updatedAt->caption() ?></td>
			<td<?php echo $image->updatedAt->cellAttributes() ?>>
<span id="el_image_updatedAt">
<span<?php echo $image->updatedAt->viewAttributes() ?>>
<?php echo $image->updatedAt->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
