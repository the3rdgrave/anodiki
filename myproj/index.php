<?php include 'header.php'; ?>
<body>



  <form method="post" action="verifyLogin.php">
  <table id="logintable" align="center">
    <tr>
      <td><label for="username">ΟΝΟΜΑ ΧΡΗΣΤΗ</label>
      </td>
      <td>
        <input type="text" id="username" name="username">
      </td>
    </tr>
    <tr>
      <td><label for="password">ΚΩΔΙΚΟΣ</label>
      </td>
      <td>
        <input type="text" id="password" name="password">
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center">
        <button name="loginbutton">Είσοδος</button>
      </td>
    </tr>
  </table>
</form>
</body>

</html>
