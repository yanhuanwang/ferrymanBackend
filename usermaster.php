<?php
namespace PHPMaker2019\ferryman;
?>
<?php if ($user->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_usermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($user->username->Visible) { // username ?>
		<tr id="r_username">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->username->caption() ?></td>
			<td<?php echo $user->username->cellAttributes() ?>>
<span id="el_user_username">
<span<?php echo $user->username->viewAttributes() ?>>
<?php echo $user->username->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->_email->caption() ?></td>
			<td<?php echo $user->_email->cellAttributes() ?>>
<span id="el_user__email">
<span<?php echo $user->_email->viewAttributes() ?>>
<?php echo $user->_email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->gender->Visible) { // gender ?>
		<tr id="r_gender">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->gender->caption() ?></td>
			<td<?php echo $user->gender->cellAttributes() ?>>
<span id="el_user_gender">
<span<?php echo $user->gender->viewAttributes() ?>>
<?php echo $user->gender->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->phone->caption() ?></td>
			<td<?php echo $user->phone->cellAttributes() ?>>
<span id="el_user_phone">
<span<?php echo $user->phone->viewAttributes() ?>>
<?php echo $user->phone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->address->caption() ?></td>
			<td<?php echo $user->address->cellAttributes() ?>>
<span id="el_user_address">
<span<?php echo $user->address->viewAttributes() ?>>
<?php echo $user->address->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->country->Visible) { // country ?>
		<tr id="r_country">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->country->caption() ?></td>
			<td<?php echo $user->country->cellAttributes() ?>>
<span id="el_user_country">
<span<?php echo $user->country->viewAttributes() ?>>
<?php echo $user->country->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->photo->Visible) { // photo ?>
		<tr id="r_photo">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->photo->caption() ?></td>
			<td<?php echo $user->photo->cellAttributes() ?>>
<span id="el_user_photo">
<span>
<?php echo GetFileViewTag($user->photo, $user->photo->getViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->nickname->Visible) { // nickname ?>
		<tr id="r_nickname">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->nickname->caption() ?></td>
			<td<?php echo $user->nickname->cellAttributes() ?>>
<span id="el_user_nickname">
<span<?php echo $user->nickname->viewAttributes() ?>>
<?php echo $user->nickname->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->region->Visible) { // region ?>
		<tr id="r_region">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->region->caption() ?></td>
			<td<?php echo $user->region->cellAttributes() ?>>
<span id="el_user_region">
<span<?php echo $user->region->viewAttributes() ?>>
<?php echo $user->region->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->locked->Visible) { // locked ?>
		<tr id="r_locked">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->locked->caption() ?></td>
			<td<?php echo $user->locked->cellAttributes() ?>>
<span id="el_user_locked">
<span<?php echo $user->locked->viewAttributes() ?>>
<?php echo $user->locked->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->send_role->Visible) { // send_role ?>
		<tr id="r_send_role">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->send_role->caption() ?></td>
			<td<?php echo $user->send_role->cellAttributes() ?>>
<span id="el_user_send_role">
<span<?php echo $user->send_role->viewAttributes() ?>>
<?php echo $user->send_role->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->carrier_role->Visible) { // carrier_role ?>
		<tr id="r_carrier_role">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->carrier_role->caption() ?></td>
			<td<?php echo $user->carrier_role->cellAttributes() ?>>
<span id="el_user_carrier_role">
<span<?php echo $user->carrier_role->viewAttributes() ?>>
<?php echo $user->carrier_role->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->birthday->Visible) { // birthday ?>
		<tr id="r_birthday">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->birthday->caption() ?></td>
			<td<?php echo $user->birthday->cellAttributes() ?>>
<span id="el_user_birthday">
<span<?php echo $user->birthday->viewAttributes() ?>>
<?php echo $user->birthday->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->addDate->Visible) { // addDate ?>
		<tr id="r_addDate">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->addDate->caption() ?></td>
			<td<?php echo $user->addDate->cellAttributes() ?>>
<span id="el_user_addDate">
<span<?php echo $user->addDate->viewAttributes() ?>>
<?php echo $user->addDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->updateDate->Visible) { // updateDate ?>
		<tr id="r_updateDate">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->updateDate->caption() ?></td>
			<td<?php echo $user->updateDate->cellAttributes() ?>>
<span id="el_user_updateDate">
<span<?php echo $user->updateDate->viewAttributes() ?>>
<?php echo $user->updateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($user->activated->Visible) { // activated ?>
		<tr id="r_activated">
			<td class="<?php echo $user->TableLeftColumnClass ?>"><?php echo $user->activated->caption() ?></td>
			<td<?php echo $user->activated->cellAttributes() ?>>
<span id="el_user_activated">
<span<?php echo $user->activated->viewAttributes() ?>>
<?php echo $user->activated->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
