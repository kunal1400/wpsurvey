<form id="regForm" action="">
  <div class="tab">
    <h1 class="blueColor">WHAT BEST DESCRIBES YOU?</h1>
    <h3>Take Our 3 Part Questionnaire So We Can Deliver You the Exact Content you Need Right Now</h3>
  </div>
  <div class="tab">
    <b>1.&nbsp;How would you best describe yourself?</b>
    <div><input type="radio" style="width: auto !important;" id="describe" required name="describe" value="1" oninput="">&nbsp;Solopreneur Working Alone</div>
    <div><input type="radio" style="width: auto !important;" id="describe" name="describe" value="2" oninput="">&nbsp;Entrepreneur and/or Small Team</div>
    <div><input type="radio" style="width: auto !important;" id="describe" name="describe" value="3" oninput="">&nbsp;Small Business Owner and/or Manager</div>
    <div><input type="radio" style="width: auto !important;" id="describe" name="describe" value="4" oninput="">&nbsp;Freelance Service Provider</div>
  </div>
  <div class="tab"><b>2.&nbsp;What is it you are in need off right now?</b>
    <div><input type="radio" style="width: auto !important;" id="need" name="need" required value="5" oninput="" />&nbsp;Introduction to Outsourcing</div>
    <div><input type="radio" style="width: auto !important;" id="need" name="need" value="6" oninput="" />&nbsp;Done For You Outsourcing</div>
    <div><input type="radio" style="width: auto !important;" id="need" name="need" value="7" oninput="" />&nbsp;Integrating Outsourcing</div>
    <div><input type="radio" style="width: auto !important;" id="need" name="need" value="8" oninput="" />&nbsp;Understanding Freelancers</div>
    <div><input type="radio" style="width: auto !important;" id="need" name="need" value="9" oninput="" />&nbsp;Project Planning and Management</div>
  </div>
  <div class="tab"><b>3.&nbsp;What category of outsourcing are you interested in?</b>
    <div><input type="radio" style="width: auto !important;" id="category" required name="category" value="10" oninput="">&nbsp;Administrative Support</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="11" oninput="">&nbsp;Business Services</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="12" oninput="">&nbsp;Graphic Design Services</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="13" oninput="">&nbsp;IT & Networking Support</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="14" oninput="">&nbsp;Multimedia Services</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="15" oninput="">&nbsp;Sales & Marketing Services</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="16" oninput="">&nbsp;SEO & Link Building Services</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="17" oninput="">&nbsp;Software Development</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="18" oninput="">&nbsp;Website Development</div>
    <div><input type="radio" style="width: auto !important;" id="category" name="category" value="19" oninput="">&nbsp;Writing Services</div>
  </div>
  <div class="tab">
    <b>4.&nbsp;Is there anything specific you would like help with?</b>
    <div><textarea style="max-width: 100%;" id="emailMessage" placeholder="...." cols="60" rows="5"></textarea></div>
    <div>Email: <input style="max-width: 100%;" id="emailId" type="email" data-validation="none" /></div>
    <div>We will answer within 24 hours</div>
  </div>
  <div class="tab">Thanks for completing this questionnaire, click FINISH to recieve your recommended content.
  </div>
  <div style="overflow:auto;">
    <div style="width: 100%;text-align: center;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <button type="button" id="getSurvey" onclick="mySurvey()">FINISH</button>
      <a id="notNowButton" href="<?php echo site_url() ?>">Not now thanks</a>
    </div>
  </div>
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
<div id="div1"></div>
<script>
  var tr;
  var currentTab = 0;
  showTab(currentTab);
</script>
