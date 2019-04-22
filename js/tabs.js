  jQuery(document).ready(function() {
    jQuery(".deleteCookieButton").on("click", function() {
      var cookieName = jQuery(this).attr("data-cookieName");
      if(cookieName) {
        console.log(cookieName + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;')
        document.cookie = cookieName + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
      }
    })
  })

  function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:

    if(n == 0) {
      document.getElementById("nextBtn").innerHTML = "Start";
      document.getElementById("nextBtn").style.display = "inline";
      document.getElementById("prevBtn").style.display = "none";
      document.getElementById("notNowButton").style.display = "block";
      document.getElementById("getSurvey").style.display = "none";
    }
    // else if( n == (1 || 2 || 3 || 4) ) {
    //
    // }
    else if(n == (x.length - 1)) {
      //document.getElementById("nextBtn").innerHTML = "Submit";
      //document.getElementById("nextBtn").disabled = true;
      document.getElementById("prevBtn").style.display = "inline";
      document.getElementById("nextBtn").style.display = "none";
      document.getElementById("getSurvey").style.display = "inline";
    }
    else {
      document.getElementById("nextBtn").disabled = false;
      document.getElementById("nextBtn").innerHTML = "Next";
      document.getElementById("nextBtn").style.display = "inline";
      document.getElementById("prevBtn").style.display = "inline";
      document.getElementById("notNowButton").style.display = "none";
      document.getElementById("getSurvey").style.display = "none";
    }
    // ... and run a function that displays the correct step indicator:

    fixStepIndicator(n)
  }


  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      //document.getElementById("regForm").submit();
      //alert(document.getElementById("div1").innerHTML);
      readQues(document.getElementById("div1").innerHTML);
      //return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function abc(lin){
        alert("lin");
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");

    if(y.length > 0) {
      var allRadioButtonsValue = []
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {

        // If input type is radio then saving their value for next check at last
        if(y[i].type == 'radio') {
          allRadioButtonsValue.push(y[i].checked);
          //console.log(y[i].type, 'consoling each element of tab', i, y[i].checked)
        }

        // This code is for all the elments who has input and value attribute, so if value is empty then that input will become required
        if( y[i].getAttribute('data-validation') !== 'none') {
          // If a field is empty...
          if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false:
            valid = false;
          }
        }
        // If type of any input is email then verifying that it is proper input
        if( y[i].type === 'email' && y[i].value != '' ) {
          if( !ValidateEmail(y[i].value) ) {
            valid = false
          }
        }
      }

      // verifying that we push the value only from checkboxes
      if(allRadioButtonsValue.length > 0 ) {
        if(allRadioButtonsValue.indexOf(true) === -1) {
          valid = false
          alert('Please select at least one option to proceed next')
        }
        //console.log(allRadioButtonsValue.indexOf(true), 'radio button is not checked');
      }

    }

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
  }

  function mySurvey(){
    var describe = document.getElementsByName("describe");
    var error = "Nothing was selected for description!";
    for (i=0, length= describe.length; i<length; i++){
      if (describe[i].checked){
        describe = describe[i].value;
        error = "";
        break;
      }
    }
    if (error != ""){
      alert(error);
      return;
    }

    var error = "Nothing was selected for need!";
    var need = document.getElementsByName("need");
    for (var i=0, length= need.length; i<length; i++){
      if (need[i].checked){
        need = need[i].value;
        error = "";
        break;
      }
    }
    if (error != ""){
      alert(error);
      return;
    }

    var error = "Nothing was selected category!";
    var category = document.getElementsByName("category");
    for (var i=0, length= category.length; i<length; i++){
      if (category[i].checked){
        category = category[i].value;
        error = "";
        break;
      }
    }
    if (error != ""){
      alert(error);
      return;
    }

    var emailMessage = document.getElementById("emailMessage").value;
    var emailId = document.getElementById("emailId").value;

    // If email and emailMessage both are present then send email
    if(emailMessage && emailId) {
      // preparing data to send
      var data = {
        'action':'custom_survey_email',
        'emailId': emailId,
        'emailMessage': emailMessage,
      };
      jQuery.post(
        custom_survey_js.ajaxurl,
        data,
        function(response) {
          console.log(response);
        });

    }

    window.location.assign("?need="+need+"&category="+category+"&describe="+describe+"&emailId="+emailId+"&emailMessage="+emailMessage);
    //readQues(ans);
  }

  function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
      return (true)
    }
    alert("You have entered an invalid email address!")
    return (false)
  }
