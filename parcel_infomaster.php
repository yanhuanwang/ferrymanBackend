<?php
namespace PHPMaker2019\ferryman;
?>
<?php if ($parcel_info->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_parcel_infomaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($parcel_info->from_place->Visible) { // from_place ?>
		<tr id="r_from_place">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->from_place->caption() ?></td>
			<td<?php echo $parcel_info->from_place->cellAttributes() ?>>
<span id="el_parcel_info_from_place">
<span<?php echo $parcel_info->from_place->viewAttributes() ?>>
<?php echo $parcel_info->from_place->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->to_place->Visible) { // to_place ?>
		<tr id="r_to_place">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->to_place->caption() ?></td>
			<td<?php echo $parcel_info->to_place->cellAttributes() ?>>
<span id="el_parcel_info_to_place">
<span<?php echo $parcel_info->to_place->viewAttributes() ?>>
<?php echo $parcel_info->to_place->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->description->Visible) { // description ?>
		<tr id="r_description">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->description->caption() ?></td>
			<td<?php echo $parcel_info->description->cellAttributes() ?>>
<span id="el_parcel_info_description">
<span<?php echo $parcel_info->description->viewAttributes() ?>>
<?php echo $parcel_info->description->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->user_id->Visible) { // user_id ?>
		<tr id="r_user_id">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->user_id->caption() ?></td>
			<td<?php echo $parcel_info->user_id->cellAttributes() ?>>
<span id="el_parcel_info_user_id">
<span<?php echo $parcel_info->user_id->viewAttributes() ?>>
<?php echo $parcel_info->user_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->category->Visible) { // category ?>
		<tr id="r_category">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->category->caption() ?></td>
			<td<?php echo $parcel_info->category->cellAttributes() ?>>
<span id="el_parcel_info_category">
<span<?php echo $parcel_info->category->viewAttributes() ?>>
<?php echo $parcel_info->category->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->image_id->Visible) { // image_id ?>
		<tr id="r_image_id">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->image_id->caption() ?></td>
			<td<?php echo $parcel_info->image_id->cellAttributes() ?>>
<span id="el_parcel_info_image_id">
<span<?php echo $parcel_info->image_id->viewAttributes() ?>>
<?php if ((!EmptyString($parcel_info->image_id->getViewValue())) && $parcel_info->image_id->linkAttributes() <> "") { ?>
<a<?php echo $parcel_info->image_id->linkAttributes() ?>><?php echo $parcel_info->image_id->getViewValue() ?></a>
<?php } else { ?>
<?php echo $parcel_info->image_id->getViewValue() ?>
<?php } ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($parcel_info->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="<?php echo $parcel_info->TableLeftColumnClass ?>"><?php echo $parcel_info->name->caption() ?></td>
			<td<?php echo $parcel_info->name->cellAttributes() ?>>
<span id="el_parcel_info_name">
<span<?php echo $parcel_info->name->viewAttributes() ?>>
<?php echo $parcel_info->name->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
