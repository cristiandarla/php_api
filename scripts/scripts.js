function check(typ){
	switch(typ){
		case 'password':{
			let password = document.getElementById("password").value;
			let confirmPassword = document.getElementById("rpassword").value;
			
			if (password != confirmPassword) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Passwords do not match!'
				});
				return false;
			}
			return true;
		}
		case 'name':{
			let name = document.getElementById("name").value;
			let confirmName = document.getElementById("rname").value;
			
			if (name != confirmName) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Names do not match!'
				});
				return false;
			}
			return true;
		}
		case 'email':{
			let email = document.getElementById("email").value;
			let confirmEmail = document.getElementById("remail").value;
			
			if (email != confirmEmail) {
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Emails do not match!'
				});
				return false;
			}
	return true;
		}
	}
    
}