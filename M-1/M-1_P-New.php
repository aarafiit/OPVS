<?php

session_start();


if (!isset($_SESSION["user_email"])) {
    // Redirect the user to the login page
    header("Location: /M-1/M-1_P-2.php");
    exit(); // Make sure to exit after a header redirection
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Police Verification System</title>
    <link rel="stylesheet" href="M-1_P-New.css">
</head>
<body>
    <!-- Header with Logo -->
    <header class="header">
        <div class="logo">
            <img src="/images/sb-logo.jpeg" alt="Online Police Verification System Logo">
            <h1>Online Police Verification System</h1>
        </div>
    </header>


    <div class="sidebar">
        <button onclick="window.location.href ='M-1_P-Home.php'; " >Home</button>
        <button onclick="window.location.href ='M-1_P-MyInfo.php'; ">My Info</button>
        <button onclick="window.location.href ='M-1_P-Help.php';">Help</button>
        <button onclick="window.location.href ='M-1_P-Status.php';">Status</button>
        <button onclick="window.location.href='/M-1/logOut.php';">Log Out</button>
        <p style="font-size: 12px;
    color: white;
    font-weight: bold;
    position: absolute;
    top: 83%;
    background-color: #343131;
    width: 109px;">All rights reserved by IIT,NSTU.</p>
      </div>

    <!-- Main Content -->
    <main class="content">
        <div class="container">
        <form id = "myForm" action="formDataCollection.php" method="POST">
            <div class = "form-group">
            <label for="date">Date:</label>
        <input type="text" id="date" name="date" readonly>
            </div>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="id">Nationality:</label>
                <select id="dropdown" name="nationality">
                    <option value="Bangladesh">Bangladeshi</option>
                    <option value="other">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id">Institute for which you are applying</label>
                <select id="dropdown" name="institute">
                    <option value="rafi2515@student.nstu.edu.bd">Education Ministry</option>
                    <option value="rafiabdullah748@gmail.com">Bangladesh Police</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Father's Name:</label>
                <input type="text" id="fatherName" name="fatherName" required>
            </div>
            <div class="form-group">
                <label for="address">Permanent Address(Road No.,P/O, Upzilla, District)</label>
                <textarea id="per_address" name="per_address" required></textarea>
            </div>
            <div class="form-group">
                <label for="address">Present Address(Road No. P/O Upzilla District)</label>
                <textarea id="pre_address" name="pre_address" required></textarea>
            </div>


            <label for="address">Places Applicant stayed more than 6 months in the last 5 years :</label>
            <div class="form-group">
                <table>
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="atext1" min="1900" max="2099" step="1" ></td>
                            <td><input type="date" name="adate1" ></td>
                            <td><input type="date" name="adate2" ></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="atext2" ></td>
                            <td><input type="date" name="adate3" ></td>
                            <td><input type="date" name="adate4" ></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="atext3" ></td>
                            <td><input type="date" name="adate5" ></td>
                            <td><input type="date" name="adate6" ></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="atext4"></td>
                            <td><input type="date" name="adate7"></td>
                            <td><input type="date" name="adate8"></td>
                        </tr>
                    </tbody>
                </table>
            </div>



            <!-- <label for="address">Places Applicant stayed more than 6 months in the last 5 years:</label>
            <div class="form-group">
                <table id="addressTable">
                    <thead>
                        <tr>
                            <th>Address</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="atext1" ></td>
                            <td><input type="date" name="adate1"></td>
                            <td><input type="date" name="adate2"></td>
                        </tr>
                    </tbody>
                </table>
                <button id="addRow" style = "width: 9%;background-color: black;margin: 7px 0;">Add</button>
            </div>

            
            <div id="error" style="color: red;"></div> -->



            <div class="form-group" id="dob" style="margin-bottom: 20px;">
                <label for="dob" style="font-weight: bold; display: block; margin-bottom: 5px;">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required style="width: 35%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);">
            </div> 

            <div class="form-group">
                <label for="birthPlace">Birth Place:</label>
                <input type="text" id="birthPlace" name="birthPlace" required style="width: 55%; height : 5%">
            </div>

            <div class="form-group">
                <label for="educationalQualification">Educational Qulaification : </label>
                <table>
                    <thead>
                        <tr>
                            <th>Institution Name </th>
                            <th>Registration/Roll No.</th>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="etext1" placeholder="Primary Level"></td>
                            <td><input type="text" name="etext2" ></td>
                            <td><input type="date" name="edate1" ></td>
                            <td><input type="date" name="edate2" ></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="etext3" placeholder="Secondary Level"></td>
                            <td><input type="text" name="etext4"></td>
                            <td><input type="date" name="edate3"></td>
                            <td><input type="date" name="edate4"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="etext5" placeholder="Higher Secondary Level"></td>
                            <td><input type="text" name="etext6"></td>
                            <td><input type="date" name="edate5"></td>
                            <td><input type="date" name="edate6"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="etext7" placeholder="University"></td>
                            <td><input type="text" name="etext8"></td>
                            <td><input type="date" name="edate7"></td>
                            <td><input type="date" name="edate8"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="workplaces">Previous Work history : </label>
                <table>
                    <thead>
                        <tr>
                            <th>Institution/Business Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>On The Job?</th>
                            <th>Reason for leaving</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="wtext1"></td>
                            <td><input type="date" name="wdatefrom1"></td>
                            <td><input type="date" name="wdateto1"></td>
                            <td><input type="radio" id="yes" name="wyesno1" value="yes">Yes
                                <input type="radio" id="no" name="wyesno1" value="no" >No</td>
                                <td><input type="text" name="wreason1"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="wtext2"></td>
                            <td><input type="date" name="wdatefrom2"></td>
                            <td><input type="date" name="wdateto2"></td>
                            <td><input type="radio" id="yes" name="wyesno2" value="yes" >Yes
                                <input type="radio" id="no" name="wyesno2" value="no" >No</td>
                                <td><input type="text" name="wreason2"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="wtext3"></td>
                            <td><input type="date" name="wdatefrom3"></td>
                            <td><input type="date" name="wdateto3"></td>
                            <td><input type="radio" id="yes" name="wyesno3" value="yes" >Yes
                                <input type="radio" id="no" name="wyesno3" value="no" >No</td>
                                <td><input type="text" name="wreason3"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="wtext4"></td>
                            <td><input type="date" name="wdatefrom4"></td>
                            <td><input type="date" name="wdateto4"></td>
                            <td><input type="radio" id="yes" name="wyesno4" value="yes" >Yes
                                <input type="radio" id="no" name="wyesno4" value="no" >No</td>
                                <td><input type="text" name="wreason4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="ffquota">Child of freedom fighter ? </label>
                <input type="radio" id="yes" name="ffqyesno" value="yes" >Yes
                                <input type="radio" id="no" name="ffqyesno" value="no" >No
            </div>

            <div class="form-group">
                <label for="disability">Disable ? </label>
                <input type="radio" id="yes" name="disabilityyesno" value="yes" >Yes
                                <input type="radio" id="no" name="disabilityyesno" value="no" >No
            </div>

            <div class="form-group">
                <label for="offence">ফৌজদারি, রাজনৈতিক বা অন্য কোনো মামলায় অভিযুক্ত থাকলে তার বিবরণ  </label>
                <select id="offenceType" name="offenceType">
                    <option value="criminal">Criminal</option>
                    <option value="political">Political</option>
                    <option value="others">Others</option>   
                </select>
                <input type="text" id="crimeno" name="crimeno" placeholder = "Case/GD No.">
                <input type="date" name="crime_des" id="crime_des">
            </div>


            <div class="form-group">
                <label for="relativesInGovtJob">Any relatives in Government Job? </label>
                <table>
                    <thead>
                        <tr>
                            <th>Name of relative</th>
                            <th>Designation</th>
                            <th>Institution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="rname1"></td>
                            <td><input type="text" name="rdes1"></td>
                            <td><input type="text" name="rinst1"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="rname2"></td>
                            <td><input type="text" name="rdes2"></td>
                            <td><input type="text" name="rinst2"></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="reference">Reference </label>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="pname1"></td>
                            <td><input type="text" name="padd1"></td>
                            
                        </tr>
                        <tr>
                            <td><input type="text" name="pname2"></td>
                            <td><input type="text" name="padd2"></td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <label for="maritialStatus">Maratial Status:</label>
                <input type="radio"  name="maritialStatus" value="married" >Married
                                <input type="radio"  name="maritialStatus" value="unmarried" >Unmarried
            </div>
          

            <button type="submit">Submit</button>
        </form>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // JavaScript form validation
        const form = document.getElementById('myForm');
        form.addEventListener('submit', function (event) {
            let isValid = true;

            // Validation for Full Name (Required)
            const fullName = document.getElementById('name').value.trim();
            if (fullName === '') {
                alert('Full Name is required.');
                isValid = false;
            }

            // Validation for Nationality (Required)
            const nationality = document.getElementById('dropdown').value;
            if (nationality === '') {
                alert('Nationality is required.');
                isValid = false;
            }

            // Validation for Father's Name (Required)
            const fatherName = document.getElementById('fatherName').value.trim();
            if (fatherName === '') {
                alert("Father's Name is required.");
                isValid = false;
            }

            // Validation for Permanent Address (Required)
            const perAddress = document.getElementById('per_address').value.trim();
            if (perAddress === '') {
                alert('Permanent Address is required.');
                isValid = false;
            }

            // Validation for Present Address (Required)
            const preAddress = document.getElementById('pre_address').value.trim();
            if (preAddress === '') {
                alert('Present Address is required.');
                isValid = false;
            }

            // Add more validation for other fields as needed

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });

    const nameInput = document.getElementById('name');

// Add an event listener to the input field
nameInput.addEventListener('input', function (event) {
    // Get the input value
    const inputValue = event.target.value;

    // Use a regular expression to check for numeric characters
    const containsNumbers = /\d/.test(inputValue);

    // If numeric characters are found, prevent them from being entered
    if (containsNumbers) {
        event.target.value = inputValue.replace(/\d/g, ''); // Remove numeric characters
    }
});

const fatherNameInput = document.getElementById('fatherName');

// Add an event listener to the input field
fatherNameInput.addEventListener('input', function (event) {
    // Get the input value
    const inputValue = event.target.value;

    // Use a regular expression to check for numeric characters
    const containsNumbers = /\d/.test(inputValue);

    // If numeric characters are found, prevent them from being entered
    if (containsNumbers) {
        event.target.value = inputValue.replace(/\d/g, ''); // Remove numeric characters
    }
});
</script>


<script>
        // Function to get today's date in yyyy-mm-dd format
        function getTodayDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Set the input field value to today's date when the page loads
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("date").value = getTodayDate();
        });
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addRowButton = document.getElementById("addRow");
        const tableBody = document.querySelector("#addressTable tbody");

        let rowCount = 2; // Initial row count

        addRowButton.addEventListener("click", function () {
            rowCount++;
            const newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td><input type="text" name="atext${rowCount}"></td>
                <td><input type="date" name="adate${rowCount * 2 - 1}"></td>
                <td><input type="date" name="adate${rowCount * 2}"></td>
                <td><button class="removeRow">Remove</button></td>
            `;
            tableBody.appendChild(newRow);

            // Add event listener to the remove button of the new row
            const removeButtons = document.querySelectorAll(".removeRow");
            removeButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    this.closest("tr").remove();
                });
            });
        });

        // Add event listener to the remove button of the initial row
        const removeButtons = document.querySelectorAll(".removeRow");
        removeButtons.forEach((button) => {
            button.addEventListener("click", function () {
                this.closest("tr").remove();
            });
        });
    });
</script> 



<!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addRowButton = document.getElementById("addRow");
            const tableBody = document.querySelector("#addressTable tbody");
            const errorDiv = document.getElementById("error");

            addRowButton.addEventListener("click", function () {
                const fromDateInput = document.querySelector("input[name='adate1']");
                const toDateInput = document.querySelector("input[name='adate2']");
                
                // Parse the date values from the inputs
                const fromDate = new Date(fromDateInput.value);
                const toDate = new Date(toDateInput.value);

                // Calculate the difference in milliseconds
                const timeDifference = toDate - fromDate;

                // Calculate the difference in months
                const monthsDifference = timeDifference / (1000 * 60 * 60 * 24 * 30.44); // Approximate number of days in a month

                if (monthsDifference >= 6) {
                    // Continue adding the row
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td><input type="text" name="atext${tableBody.childElementCount + 1}"></td>
                        <td><input type="date" name="adate${tableBody.childElementCount * 2 + 1}"></td>
                        <td><input type="date" name="adate${tableBody.childElementCount * 2 + 2}"></td>
                    `;
                    tableBody.appendChild(newRow);
                    errorDiv.textContent = ''; // Clear any previous error message
                } else {
                    // Show an error message and prevent adding a row
                    errorDiv.textContent = 'The period must be 6 months or more.';
                }
            });
        });
    </script> -->





    </main>
</body>
</html>
