const form = document.getElementById("form1");

form.addEventListener("submit",function(event){
  const isValied = validateRegistrationForm();
  if(!isValied){
    event.preventDefault();
  }
})

function validateRegistrationForm() {
  // Get form inputs
  const name = document.getElementById("fullname").value.trim();
  const email = document.getElementById("email").value.trim();
  const address = document.getElementById("address").value.trim();
  const mobile = document.getElementById("mobile").value.trim();
  const password = document.getElementById("password").value.trim();
  const confPassword = document.getElementById("confpassword").value.trim();
  const avatar = document.getElementById("image").value;

  // Regex patterns
  const mobilePattern = /^\d{10}$/;
  const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d@$.!%*#?&_-]{8,}$/;
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // Flag to track errors
  let hasError = false;

  // Validate name
  if (name === "") {
    document.getElementById("error-name").innerText = "Name is required";
    hasError = true;
  } else {
    document.getElementById("error-name").innerText = "";
  }

  // Validate email
  if (email === "") {
    document.getElementById("error-email").innerText = "Email is required";
    hasError = true;
  } else if (!emailPattern.test(email)) {
    document.getElementById("error-email").innerText = "Invalid email format";
    hasError = true;
  } else {
    document.getElementById("error-email").innerText = "";
  }

  // Validate address
  if (address === "") {
    document.getElementById("error-address").innerText = "Address is required";
    hasError = true;
  } else {
    document.getElementById("error-address").innerText = "";
  }

  // Validate mobile
  if (mobile === "") {
    document.getElementById("error-contact").innerText = "Mobile is required";
    hasError = true;
  } else if (!mobilePattern.test(mobile)) {
    document.getElementById("error-contact").innerText = "Invalid mobile number format";
    hasError = true;
  } else {
    document.getElementById("error-contact").innerText = "";
  }

  // Validate password
  if (password === "") {
    document.getElementById("error-password").innerText = "Password is required";
    hasError = true;
  } else if (!passwordPattern.test(password)) {
    document.getElementById("error-password").innerText = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number";
    hasError = true;
  } else {
    document.getElementById("error-password").innerText = "";
  }

  // Validate confirm password
  if (confPassword === "") {
    document.getElementById("error-match").innerText = "Confirm password is required";
    hasError = true;
  } else if (confPassword !== password) {
    document.getElementById("error-match").innerText = "Passwords do not match";
    hasError = true;
  } else {
    document.getElementById("error-match").innerText = "";
  }

  // Validate image
  if (avatar === "") {
    document.getElementById("error-image").innerText = "Image is required";
    hasError = true;
  } else {
    document.getElementById("error-image").innerText = "";
  }
  
if (hasError) {
  return false;
} else {
  // Store form data in localStorage
  const formData = {
    name: name,
    email: email,
    address: address,
    mobile: mobile,
    password: password,
    avatar: avatar
  };
  const existingData = localStorage.getItem('formData');
  const newData = existingData ? JSON.parse(existingData).concat(formData) : [formData];
  localStorage.setItem('formData', JSON.stringify(newData));

  // Return true if there is no error
  return !hasError;
}


}
