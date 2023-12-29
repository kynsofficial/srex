//ELC CALCULATOR
function calculate_elc(select){

  //shipping plan
  var g = document.getElementById("shipping_plan");
  var shipping_plan = g.options[g.selectedIndex].value;

  //destination country & rate
  var e = document.getElementById("destination_country");
  var ratex = e.options[e.selectedIndex].value;
  var ratex_cbm = e.options[e.selectedIndex].getAttribute('cbm');
  var countryx = e.options[e.selectedIndex].getAttribute('myid');

  //currency type
  var f = document.getElementById("currency_type");
  var currencyx = f.options[f.selectedIndex].value;


  //shipping variables
  var costx = document.getElementById("costx").value;
  var quantityx = document.getElementById("quantityx").value;
  var weightx = document.getElementById("weightx").value;

  //verify input values
  if(costx == "" || quantityx == "" || weightx == "" || ratex == "" || currencyx == "" || shipping_plan == ""){

    //display warning
    document.getElementById("warningxx").innerHTML = "You have missing field(s), provide the value(s) above</span>"; exit;
  }
  else
  {
    //display warning
    document.getElementById("warningxx").innerHTML = "";
  }

  //calculation parameters
  var costx = parseFloat(document.getElementById("costx").value);
  var quantityx = parseFloat(document.getElementById("quantityx").value);
  var weightx = parseFloat(document.getElementById("weightx").value);



  //shipping & clearing rate (scr)
  var isc = ratex; //International shipping cost (Dollar/KG)
  var dtc = parseFloat(document.getElementById("domestic_transportation_cost").value); //Domestic transportation cost ($10 per product)
  var ex_rate_yuan_dollar = parseFloat(document.getElementById("yuan_dollar_rate").value); //yuan to dollar
  var ex_rate_naira_dollar = parseFloat(document.getElementById("naira_dollar_rate").value); //yuan to dollar
  var percentage = parseFloat(document.getElementById("service_charge_percentage").value);
  var service_charge_percentage = parseFloat(percentage/100);


  //CONDITION TO MANAGE SEA SHIPPING ONLY TO NIGERIA FOR NOW
  if(shipping_plan == "air"){}
  if(shipping_plan == "sea"){ratex = ratex_cbm;}
  if((shipping_plan == "sea") && (countryx !== "nigeria")){
    document.getElementById("info1").innerHTML = "The selected Shipping Plan can only be calculated for Nigeria ";exit;
  }


  //calculate for Dollar price
  if(currencyx == "Dollar")
  {
    var elc = costx + (costx * service_charge_percentage) + (weightx * ratex) + dtc;
    elc = (parseFloat(elc) * quantityx).toFixed(2);
    elc = parseFloat(elc);

    var elcn = (costx + (costx * service_charge_percentage) + (weightx * ratex) + dtc) * ex_rate_naira_dollar;
    elcn = (parseFloat(elcn) * quantityx).toFixed(2);
    elcn = parseFloat(elcn);

    //format for proper display in dollar currency
    var elcx = '$' + elc.toLocaleString();
    var toNaira = '₦' + elcn.toLocaleString();

    //display result
    document.getElementById("displayx").innerHTML = elcx;
    document.getElementById("displayy").innerHTML = toNaira;
    document.getElementById("info1").innerHTML = "";
  }

  //calculate for Yuan price
  if(currencyx == "Yuan")
  {
    var elc = (costx * ex_rate_yuan_dollar) + ((costx * ex_rate_yuan_dollar) * service_charge_percentage) + (weightx * ratex) + dtc;
    elc = (parseFloat(elc) * quantityx).toFixed(2);
    elc = parseFloat(elc);

    var elcn = ((costx * ex_rate_yuan_dollar) + ((costx * ex_rate_yuan_dollar) * service_charge_percentage) + (weightx * ratex) + dtc) * ex_rate_naira_dollar;
    elcn = (parseFloat(elcn) * quantityx).toFixed(2);
    elcn = parseFloat(elcn);

    //format for proper display in dollar currency
    var elcx = '$' + elc.toLocaleString();
    var toNaira = '₦' + elcn.toLocaleString() ;

    //display result
    document.getElementById("displayx").innerHTML = elcx;
    document.getElementById("displayy").innerHTML = toNaira;
    document.getElementById("info1").innerHTML = "";
  }
}

//DYNAMICALLY SELECT A COUNTRY FOR USER
function select_country(select)
{
  var my_planx = select.options[select.selectedIndex].getAttribute("myplan");

  if(my_planx == "sea"){
    //dynamically select a country for user
    $("#destination_country [myid='nigeria']").attr("selected","selected");
    document.getElementById("info1").innerHTML = "For now, our calculator does not provide calculation for Sea Shiping outside Nigeria. This means, for a Sea Shipping Plan, destination must be Nigeria as selected.";
  }
  else{
    //document.getElementById("info1").innerHTML = "";
  }
}

//RESET BUTTON
function resetx()
{
  //reset and empty fields
  document.getElementById("costx").value = "";
  document.getElementById("quantityx").value = "";
  document.getElementById("weightx").value = "";
  document.getElementById("destination_country").value = "";
  document.getElementById("shipping_plan").value = "";
  document.getElementById("currency_type").value = "";
  document.getElementById("displayx").innerHTML = "$0.00";
  document.getElementById("displayy").innerHTML = "₦0.00";
}
