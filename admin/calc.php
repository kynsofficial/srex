<style media="screen">

* {
  margin: 0;
  padding: 0;
  font-family:  'Poppins', sans-serif;
  box-sizing: border-box;
}


.container {
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.calculator {
  background: #302f30de;
  padding: 20px;
  border-radius: 15px;
  margin-top: 25px;
}

h3 {
  font-size: 30px;
  text-align: center;
  margin-top: -10px;
}


.calculator form input {
  border: 0;
  outline: 0;
  width: 60px;
  height: 60px;
  border-radius: 10px;
  box-shadow: -8px -8px 15px rgba(255, 255, 255, 0.1), 5px 5px 15px rgba(0, 0, 0, 0.2);
  font-size: 20px;
  background: transparent;
  color: #fff;
  cursor: pointer;
  margin: 8px;
}

form .display {
  display: flex;
  justify-content: flex-end;
  margin: 20px 0;
}

form .display input {
  text-align: right;
  flex: 1;
  font-size: 40px;
  height: 70px;
  padding: 5px;
  border: .5px solid rgba(255, 255, 255, 0.5);
  margin-top: -4px;
  box-shadow: none;
}


form input.equal {
  width: 145px;
  background-color: #F5F5F5;
  color: black;
}

form input.yellow {
  background-color: #ff8d13e8;
  text-align: center;
}

form input.red {
  background-color:#FD5D5D;
}

footer {
  position: relative;
  font-size: small;
  margin-top: 30px;
  color: black;
  text-align: center;
}

footer a {
  text-decoration: none;
  color: #050505;
  color: #FD5D5D;

}
</style>
<div class="container">
  <h3> Calculator</h3>

  <div class="calculator">
    <form action="#">
      <div class="display">
        <input type="text" name="display">
      </div>

      <div>
        <input type="button" value="AC" class="red" onclick="display.value = ''">
        <input type="button" value="DE" class="red" onclick="display.value = display.value.toString().slice(0, -1)">
        <input type="button" value="." class="yellow" onclick="display.value += '.'">
        <input type="button" value="/" class="yellow" onclick="display.value += '/'">
      </div>


      <div>
        <input type="button" value="7" onclick="display.value += '7'">
        <input type="button" value="8" onclick="display.value += '8'">
        <input type="button" value="9" onclick="display.value += '9'">
        <input type="button" value="*" class="yellow" onclick="display.value += '*'">
      </div>


      <div>
        <input type="button" value="4" onclick="display.value += '4'">
        <input type="button" value="5" onclick="display.value += '5'">
        <input type="button" value="6" onclick="display.value += '6'">
        <input type="button" value="-" class="yellow" onclick="display.value += '-'">
      </div>


      <div>
        <input type="button" value="1" onclick="display.value += '1'">
        <input type="button" value="2" onclick="display.value += '2'">
        <input type="button" value="3" onclick="display.value += '3'">
        <input type="button" value="+" class="yellow"  onclick="display.value += '+'">
      </div>


      <div>
        <input type="button" value="00" onclick="display.value += '00'">
        <input type="button" value="0" onclick="display.value += '0'">
        <input type="button" value="=" class="equal"  onclick="display.value = eval(display.value)">
      </div>


    </form>
  </div>

</div>
