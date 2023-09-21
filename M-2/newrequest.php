
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="m4styles.css">
  
  <script>
    function redirectToNewRequest() {
      window.location.href = "newrequest2.html";
    }
  </script>
</head>
<body>
  <div class="header">
    <img style="height: 25%; width:100%; border-radius: 20px;" src="homepage.png">
  </div>
  <div class="sidebar">
    <button class="active" onclick="window.location.href='homepage.html';">Home</button>
    <button onclick="window.location.href='newrequest.html';">New Verification Request</button>
    <button onclick="window.location.href='M-1_P-New.html';" >New</button>
    <button onclick="window.location.href='complete.html';">Complete File</button>
    <button onclick="window.location.href='pending.html';">Pending File</button>
    <button  onclick="window.location.href='M-1_P-1.html';" >Log Out</button>
  </div>
  <div class="content">
    <table>
      <tr>
        <th>File</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
      <tr>
        <td>Abdullah Al Rafi</td>
        <td>10.3.2023</td>
        <td>
          <button class="accept-button" style="background-color: green; color: antiquewhite;" onclick="redirectToNewRequest()">Accept</button>
          <button class="decline-button" style="background-color: red;">Decline</button>
        </td>
    </table>
  </div>
</body>
</html>



