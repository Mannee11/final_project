function validateLoginAdminForm() {
	var email = document.forms.loginadminForm.idemail.value;
	var pass = document.forms.loginadminForm.idpass.value;
	if ((email === '') || (pass === '')) {
		alert('Please fill in all required fields to proceed with your login');
		return false;
	}
	const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if (!re.test(String(email))) {
		alert('Please fill in correct email');
		return false;
	}
	setAdminCookies(10);
}
function setAdminCookies(exdays) {
    var email = document.forms["loginadminForm"]["idemail"].value;
    var pass = document.forms["loginadminForm"]["idpass"].value;
    var rememberme = document.forms["loginadminForm"]["idremember"].checked;
    console.log(email, pass, rememberme);
		if (rememberme) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires=" + d.toUTCString();
			document.cookie = "email=" + email + ";" + expires + ";path=/";
			document.cookie = "password=" + pass + ";" + expires + ";path=/";
			document.cookie = "rememberme=" + rememberme + ";" + expires + ";path=/";
    } else {
        document.cookie = "email=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
        document.cookie = "password=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
        document.cookie = "rememberme=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/";
    }
}

function getAdminCookie(email) {
    var name = email + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loadAdminCookies() {
    var username = getAdminCookie("email");
    var password = getAdminCookie("password");
    var rememberme = getAdminCookie("rememberme");
    console.log("COOKIES:" + username, password, rememberme);
    document.forms["loginadminForm"]["idemail"].value = username;
    document.forms["loginadminForm"]["idpass"].value = password;
    if (rememberme) {
        document.forms["loginadminForm"]["idremember"].checked = true;
    } else {
        document.forms["loginadminForm"]["idremember"].checked = false;
    }
}
