<?php

session_start();
        $dbHost = 'localhost'; 
        $dbName = 'opvs'; 
        $dbUser = 'root'; 
        $dbPassword = ''; 
        try {
            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_SESSION['user_email'])) {
        $userEmail = $_SESSION['user_email'];
        $date = $_POST['date'];
        $fullName = $_POST['name'];
        $fatherName = $_POST['fatherName'];
        $nationality = $_POST['nationality'];
        $institute = $_POST['institute'];
        $presentAddress = $_POST['pre_address'];
        $permanentAddress = $_POST['per_address'];
        $dateOfBirth = $_POST['dob'];
        $birthPlace = $_POST['birthPlace'];
        $ffq = isset($_POST['ffqyesno']) ? $_POST['ffqyesno'] : 'no';
        $disability = isset($_POST['disabilityyesno']) ? $_POST['disabilityyesno'] : 'no';
        $maritalStatus =  isset($_POST['maritialStatus']) ? $_POST['maritialStatus'] : 'unmarried';

        $insertIndividualUserSQL = "INSERT INTO form_info (email,full_name, father_name, nationality,institute_email, present_address, parmanent_address, date_of_birth, birth_place, ffq, disability, marital_status,status,date) VALUES (?,?,?,  ?, ?, ?, ?, ?, ?, ?, ?,?, ?,?)";
        $stmt = $pdo->prepare($insertIndividualUserSQL);
        $stmt->execute([$userEmail,$fullName, $fatherName, $nationality,$institute, $presentAddress, $permanentAddress, $dateOfBirth, $birthPlace, $ffq, $disability, $maritalStatus,'institute',$date]);
        



        $userId = $pdo->lastInsertId();



        for ($i = 1; $i <= 8; $i++) {
            $var1 = "etext";
            $var2 = "edate";

            $num = $i;
            $num2 = $i+1;

            $result = $var1 . $num;
            $result2 = $var1 . $num2;
            $result3 = $var2 . $num;
            $result4 = $var2 . $num2;

            $institute = $_POST[$result];
            $roll = $_POST[$result2];
            $fromDate = $_POST[$result3];
            $toDate = $_POST[$result4];

            $i++;


            $selectFormIdQuery = "SELECT form_id FROM form_info WHERE email = :userEmail";
    
            $stmt = $pdo->prepare($selectFormIdQuery);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $formId = $row['form_id'];

            // if ($institute && $roll && $fromDate && $toDate) {
                $insertEducationalQualificationSQL = "INSERT INTO educational_qualification (form_id, institute, roll, studied_from, studied_to) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($insertEducationalQualificationSQL);
                $stmt->execute([$userId, $institute, $roll, $fromDate, $toDate]);
            // }
        }
        }


        for ($i = 1; $i <= 4; $i++) {
            $var1 = "wtext";
            $var2 = "wdatefrom";
            $var3 = "wdateto";
            $var4 = "wreason";
            $var5 = "wyesno";
            

            $num = $i;
            
            $result = $var1 . $num;
            $result2 = $var2 . $num;
            $result3 = $var3 . $num;
            $result4 = $var4 . $num;
            $result5 = $var5 .$num;

            $name = $_POST[$result];
            $datefrom = $_POST[$result2];
            $dateto = $_POST[$result3];
            $reason = $_POST[$result4];
            $yesno = isset($_POST[$result5]) ? $_POST[$result5] : 'no';
            


            $selectFormIdQuery = "SELECT form_id FROM form_info WHERE email = :userEmail";
    
            $stmt = $pdo->prepare($selectFormIdQuery);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $formId = $row['form_id'];

            // if ($name && $datefrom && $dateto && $reason) {
                $insertEducationalQualificationSQL = "INSERT INTO work_history (form_id, workplace_name, worked_from, worked_to, reason_of_leaving,still_working) VALUES (?, ?, ?, ?, ?,?)";
                $stmt = $pdo->prepare($insertEducationalQualificationSQL);
                $stmt->execute([$userId, $name, $datefrom, $dateto, $reason,$yesno]);
            
        }
        }

        // places
        for ($i = 1; $i <= 4; $i++) {
            $var1 = "atext";
            $var2 = "adate";
   
            $num = $i;
            $num2  = $i*2;
            $num3 = ($i*2)-1;
            
            $result = $var1 . $num;
            $result2 = $var2 . $num3;
            $result3 = $var2 . $num2;
           

            $address = $_POST[$result];
            $datefrom = $_POST[$result2];
            $dateto = $_POST[$result3];
  
            $selectFormIdQuery = "SELECT form_id FROM form_info WHERE email = :userEmail";
    
            $stmt = $pdo->prepare($selectFormIdQuery);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $formId = $row['form_id'];

            // if ($name && $datefrom && $dateto && $reason) {
                $insertEducationalQualificationSQL = "INSERT INTO stayed_places (form_id, adress, stayed_from, stayed_to) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($insertEducationalQualificationSQL);
                $stmt->execute([$userId, $address, $datefrom, $dateto]);
            // }
        }
        }

        //relatives

        for ($i = 1; $i <= 2; $i++) {
            $var1 = "rname";
            $var2 = "rdes";
            $var3  = "rinst";
          

            $num = $i;
            
            $result = $var1 . $num;
            $result2 = $var2 . $num;
            $result3 = $var3 . $num;
           

            $name = $_POST[$result];
            $des = $_POST[$result2];
            $inst = $_POST[$result3];

            $selectFormIdQuery = "SELECT form_id FROM form_info WHERE email = :userEmail";
    
            $stmt = $pdo->prepare($selectFormIdQuery);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $formId = $row['form_id'];

            // if ($name && $datefrom && $dateto && $reason) {
                $insertEducationalQualificationSQL = "INSERT INTO relatives (form_id, name, designation, institution) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($insertEducationalQualificationSQL);
                $stmt->execute([$userId, $name, $des, $inst]);
            // }
        }
        }

            

        // reference

        for ($i = 1; $i <= 2; $i++) {
            $var1 = "pname";
            $var2 = "padd";

            $num = $i;
            
            $result = $var1 . $num;
            $result2 = $var2 . $num;

            $name = $_POST[$result];
            $add = $_POST[$result2];

            $selectFormIdQuery = "SELECT form_id FROM form_info WHERE email = :userEmail";
    
            $stmt = $pdo->prepare($selectFormIdQuery);
            $stmt->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $formId = $row['form_id'];

            // if ($name && $datefrom && $dateto && $reason) {
                $insertEducationalQualificationSQL = "INSERT INTO reference (form_id, name, address) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($insertEducationalQualificationSQL);
                $stmt->execute([$userId, $name, $add]);
            // }
        }
        }


        // status update 
        // $form_id_value = $userId;
        // $institute_value = "YES";

        // // SQL query to insert data into specific columns of the "status" table
        // $sql = "INSERT INTO status (form_id, on_institute) VALUES (?, ?)";

        // // Prepare the SQL statement
        // $stmt = $conn->prepare($sql);

        // // Bind parameters
        // $stmt->bind_param("ss", $form_id_value, $institute_value);



        // // include "selectInstitute.php";
        header("Location: M-1_P-MyInfo.php");
        exit;
       




        
    } else {
        echo "Email is missing from the session.";
    }


}

?>



