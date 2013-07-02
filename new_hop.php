
<div id='new_hop_explanation'>
You are about to create a new Hop - Your wish to find a product with targeted discount.<br>
If you get enough followers by the expiration date you set for this hop,<br>
some vendor might accept the terms you wanted.<br><br>
If this should be the case, you will be notified from that vendor per email or phone!<br><br>
Good Luck!<br>
</div>

<div id='new_hop_form'>
<form class='nhForm' id='nhForm' method='post' action='new_hop_complete.php'>
	<fieldset id='nh_fieldset'>
		<br><br>
		<ul>
		    <li><strong>Add the hop for the product of interest:</strong></li>
		</ul><br><br>
		
			
			<p>
				<label for='category'>Category</label><em>*</em>
				<select id='category' name='category'  class='' >
				<?php dropquery ('code','name','categories','name'); ?>
				</select>
			</p>
			<p class=error>&nbsp;</p>
			
			<p>	
				<label for='subcategory'>Subcategory</label><em>*</em>
				<span id="subcat_drop_down">
				
				</span>
				
     			<span id="no_subcat_drop_down">No subcategories available.</span>
     			
			</p>
			<p class=error>&nbsp;</p>
			
			<p>
				<label for='productname'>Product Name</label><em>*</em>
				<input id='productname' title="Please use Brand Name and type if possible, e.g Sony LCD TV Bravia 55" name='productname' size='30' class='required' />
			</p>
			<p class=error>&nbsp;</p>
			
			<p>
				<label for='targetprice'>Targeted price</label><em>*</em>
				<input id='targetprice' title='Please enter the price you want to buy the product for in US $' name='targetprice' size='10'  class='required'  />
			</p>
			<p class=error>&nbsp;</p>
			
			<p>
				<label for='expirationdate'>Expiration Date</label><em>*</em>
				<input id='expirationdate' title='Please enter the date till when this hop is valid' name='expirationdate' size='5'  class='required' />
			</p>
			<p class=error>&nbsp;</p>

			
			<div id='dsubmit'>
			<p>
				<label for='dsubmit'>&nbsp;&nbsp;</label><em>&nbsp;</em>
				<input type='submit' value='Update' alt='Update'>
			</p>
			</div>

		
	</fieldset>
</form>	
</div>