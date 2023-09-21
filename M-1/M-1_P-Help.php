<?php

session_start();

// Check if the user is not logged in (not set in the session)
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
    <title>Document</title>
    <link rel="stylesheet" href="M-1_P-Help.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="/images/sb-logo.jpeg" alt="Online Police Verification System Logo">
            <h1>Online Police Verification System</h1>
        </div>
    </header>

    <div class="sidebar">
        <button onclick="window.location.href ='M-1_P-Home.php'; " >Home</button>
        <button onclick="window.location.href ='M-1_P-MyInfo.php'; ">My Info</button>
        <button id="current_page" onclick="window.location.href ='M-1_P-Help.php'; ">Help</button>
        <button onclick="window.location.href ='M-1_P-Status.php'; ">Status</button>
        <button onclick="window.location.href='/M-1/logOut.php';">Log Out</button>
      </div>

      <div id="main_content">
        <table id="table1">
            <thead>
                <tr>
                    <th>আবেদনের নিয়মাবলী</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>১। রেজিস্ট্রেশন সম্পন্ন করুন</td>
                </tr>
                <tr>
                    <td>২। নিউ(New) বাটনে ক্লিক করুন</td>
                </tr>
                <tr>
                    <td>৩। ফর্মে প্রয়োজনীয় তথ্য প্রদান করুন।</td>
                </tr>
                <tr>
                    <td>৪। ্সাবমিট(Submit) বাটনে ক্লিক করুন।</td>
                </tr>
                <tr>
                    <td>৫। ভেরিফিকেশনের অগ্রগতি চেকের জন্য স্টেটাস(Status) বাটনে ক্লিক করুন।</td>
                </tr>
                <tr>
                    <td>৬। প্রয়োজনীয় সাহায্যের জন্য কন্টাক্ট আস এ ক্লিক করুন। </td>
                </tr>
                
</tbody>
</table>

<!-- 
              

        <table id="table2">
            <thead>
                <tr>
                    <th>প্রয়োজনীয় ডকুমেন্টস</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>১। অনলাইনে যথাযথভাবে পূরণকৃত আবেদন পত্র । </tr>

                        <td>   ২। ১ম শ্রেণীর গেজেটেড কর্মকর্তা দ্বারা সত্যায়িত পাসপোর্টের তথ্য পাতার স্ক্যানকপি
                        অথবা
                        বিদেশে অবস্থানকারী বাংলাদেশী নাগরিকগনের ক্ষেত্রে সংশ্লিষ্ট দেশে বাংলাদেশ দূতাবাস কর্তৃক সত্যায়িত পাসপোর্টের তথ্য পাতার স্ক্যানকপি
                        অথবা
                        বিদেশী নাগরিকদের ক্ষেত্রে নিজ দেশের জাস্টিস অব পিস (Justice of Peace) কর্তৃক সত্যায়িত পাসপোর্টের তথ্য পাতার স্ক্যানকপি।
                    </tr>
                        <td>   ৩। বাংলাদেশ ব্যাংক/ সোনালী ব্যাংকের যে কোন শাখা থেকে (১-৭৩০১-০০০১-২৬৮১) কোডে করা ৫০০/- (পাঁচশত) টাকা মূল্যমানের ট্রেজারী চালান অথবা অনলাইনে ক্রেডিট/ডেবিট কার্ডের মাধ্যমে প্রযোজ্য ক্ষেত্রে নির্ধারিত সার্ভিসচার্জ সহ ফি প্রদান।</td>
                </tr>
               


        <table id="table3">
            <thead>
                <tr>
                    <th>আবেদনের নিয়মাবলী</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <tr>
                    <td>ধাপ : ১
                        
                    </td>
                    </tr>
                    <tr>
                    <td>
                    ধাপ : ২ 
                    </td>
                </tr>
                <tr>
                    <td>
                        ধাপ : ২ 
                    </td>
                    

                </tr>
-->             

                <!-- Add more rows as needed -->
            <!-- </tbody>
        </table> -->
      </div>
</body>
</html>