


function validateAddNew() {
	var primage = document.forms.addNew.idprimage.value;
	var prname = document.forms.addNew.idpname.value;
	var prtype = document.forms.addNew.idptype.value;
	var prprice = document.forms.addNew.idprice.value;
	var prqty = document.forms.addNew.idquantity.value;

	

    if ((prname === '') || (prtype === '') || (prprice === '') || (prqty === '')) {
		alert('Please fill in all required fields');
		return false;
	}

	if(primage !=''){
	}else{
		alert ("No Image is Selected...");
		return false;
	}

	if (prtype== 'noselection') {
		alert("Please select the product type...");
		return false;
	}
}


