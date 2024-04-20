<?php 
$curl = curl_init();
session_start();
$phoneNumber= $_SESSION['phoneNumber'];
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://2factor.in/API/V1/e60bd9c1-ee9c-11ee-8cbb-0200cd936042/SMS/'.$phoneNumber.'/AUTOGEN/OTP1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);


?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>OTP Verification Form</title>
    
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style type="text/css">
      /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #4070f4;
}
:where(.container, form, .input-field, header) {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.container {
  background: #fff;
  padding: 30px 65px;
  border-radius: 12px;
  row-gap: 20px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.container header {
  height: 65px;
  width: 65px;
  background: #4070f4;
  color: #fff;
  font-size: 2.5rem;
  border-radius: 50%;
}
.container h4 {
  font-size: 1.25rem;
  color: #333;
  font-weight: 500;
}
form .input-field {
  flex-direction: row;
  column-gap: 10px;
}
.input-field input {
  height: 45px;
  width: 42px;
  border-radius: 6px;
  outline: none;
  font-size: 1.125rem;
  text-align: center;
  border: 1px solid #ddd;
}
.input-field input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.input-field input::-webkit-inner-spin-button,
.input-field input::-webkit-outer-spin-button {
  display: none;
}
form button {
  margin-top: 25px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  border: none;
  padding: 9px 0;
  cursor: pointer;
  border-radius: 6px;
  pointer-events: none;
  background: #6e93f7;
  transition: all 0.2s ease;
}
form button.active {
  background: #4070f4;
  pointer-events: auto;
}
form button:hover {
  background: #0e4bf1;
}
    </style>
   <script src="script.js" defer></script>
  </head>
  <body>
    <div class="container">
    <header>
        <i class="bx bxs-check-shield"></i>
    </header>
    <h4>Enter OTP Code</h4>
    <form action="verifyotp.php" method="post">
        <div class="input-field">
            <input type="number" maxlength="1" autofocus />
            <input type="number" maxlength="1" disabled required />
            <input type="number" maxlength="1" disabled required />
            <input type="number" maxlength="1" disabled required />
            <input type="number" maxlength="1" disabled required />
            <input type="number" maxlength="1" disabled required />
        </div>
        <button type="submit" >Verify OTP</button>
    </form>
</div>

  </body>
  
<script type="text/javascript">
const inputs = document.querySelectorAll("input"),
  button = document.querySelector("button");

// iterate over all inputs
inputs.forEach((input, index1) => {
  input.addEventListener("keyup", (e) => {
    const currentInput = input,
      nextInput = input.nextElementSibling,
      prevInput = input.previousElementSibling;

    // if the value has more than one character then clear it
    if (currentInput.value.length > 1) {
      currentInput.value = "";
      return;
    }

    // if the next input is disabled and the current value is not empty
    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
      nextInput.removeAttribute("disabled");
      nextInput.focus();
    }

    // if the backspace key is pressed
    if (e.key === "Backspace") {
      inputs.forEach((input, index2) => {
        if (index1 <= index2 && prevInput) {
          input.setAttribute("disabled");
          input.value = "";
          prevInput.focus();
        }
      });
    }

    // Enable or disable the button based on whether all fields are filled
    button.disabled = !isAllFieldsFilled();
     if (!inputs[5].disabled && inputs[5].value !== "") {
      button.classList.add("active");
      return;
    }
    button.classList.remove("active");
  });
});

// Function to check if all input fields are filled
function isAllFieldsFilled() {
  return [...inputs].every(input => input.value.trim() !== "");
}

// Event listener for the "Verify OTP" button
button.addEventListener("click", (e) => {
  // Prevent form submission
  e.preventDefault();

  // Redirect to verifyotp.php if all fields are filled
  if (isAllFieldsFilled()) {
    let otp = '';
    inputs.forEach(input => otp += input.value);
    window.location.href = `verifyotp.php?otp=${otp}`;
  }

});


// Focus the first input field on window load
window.addEventListener("load", () => inputs[0].focus());
</script>


  
</html>