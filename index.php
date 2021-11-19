<?php 
include('./config.php');
include('./functions.php');
$WS_Curl = new WS_Curl(CONFIG_URL . "/webservice.php", CONFIG_NAME, CONFIG_KEY);
$WS_Curl->login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <title>Affiliate Link</title>
    <style>

        *{font-family: 'Montserrat', sans-serif;}
        body
        {
            height:100vh;
            background-image: url(https://efanigroup.com/wp-content/uploads/2021/11/footbg.jpg);
            background-repeat: no-repeat;
        }

        label
        {
            font-size: 13px;
            line-height: 1em;
            letter-spacing: .3px;
            font-family: inherit;
            font-weight: 700;
            margin-bottom: 5px;
            color:white;
        }

        .select2    
        {
            width:100% !important;
            
        } 

        .select2-selection,
        .select2-selection--single
        {
            height: 2.5rem !important;
        }
        span.select2-selection.select2-selection--single 
        {
            padding: 7px;
        }
    </style>
</head>
<body>
        <!-- Just an image -->
<nav class="navbar navbar-light" style="background:#001438">
  <div class="container">
    <a class="navbar-brand" href="#">
        <img src="https://efanigroup.com/wp-content/uploads/2021/11/cropped-cropped-efani_logo.png" alt="Efanigroup's Home">
    </a>
  </div>
</nav>
    <div class="container mt-5">
        <div class="row">
        <div class="col-md-6">
            <form id="efaniaffiliate" action="./ws_create.php" name="affiliatelink" method="post" enctype="multipart/form-data">
                <input type="text" id="affiliateid" name="affiliateid" value="000-000-000-000">
                <input type="hidden" id="leadsource" name="leadsource" value="WEBSERVICE">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstname">First name <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" id="firstname" class="form-control rounded-0" name="billing_first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Last name <span class="text-danger">*</span></label>
                                <input type="text" id="firstname" class="form-control rounded-0" name="billing_last_name" required> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="company">Company name (optional)</label>
                                <input type="text" id="company" class="form-control rounded-0" name="billing_company">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="country">Country <span class="text-danger">*</span></label>
                                <select name="billing_country" id="country" class="form-control form-control-lg" required>
                                    <option value="US">United States(US)</option>
                                    <option value="CA">Canada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label for="address1">Street address <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <input type="text" id="address1" class="form-control rounded-0" name=" billing_address_1" placeholder="House number and street name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <div class="form-group mt-4">
                                <input type="text" id="address2" class="form-control rounded-0" name=" billing_address_2" placeholder="Apartment, suite, unit etc. (optional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="City">Town/City <span class="text-danger">*</span></label>
                                <input type="text" id="city" class="form-control rounded-0" name="billing_city">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="state">State / County <span class="text-danger">*</span></label>
                                <select name="billing_state" id="billing_state" class="state_select select2-hidden-accessible" required >
                                    <option value="">Select an option…</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option selected value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AA">Armed Forces (AA)</option>
                                    <option value="AE">Armed Forces (AE)</option>
                                    <option value="AP">Armed Forces (AP)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="zip">Postcode / ZIP <span class="text-danger">*</span></label>
                                <input type="text" id="city" class="form-control rounded-0" name="billing_postcode">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="Phone">Phone <span class="text-danger">*</span></label>
                                <input type="number" id="phone" class="form-control rounded-0" name="billing_phone">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email address <span class="text-danger">*</span></label>
                                <input type="email" id="email" class="form-control rounded-0" name=" billing_email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="referrer">Referred By: (optional)</label>
                                <input type="text" id="referrer" class="form-control rounded-0" name="billing_referred_by">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="PROCEED TO CHECKOUT" name="submit" class="form-control mt-3 text-white font-weight-bold border-0 rounded-0" style="background:#001438">
                        </div>
                    </div>
            </form>
        </div>
        <div class="col-md-6">
            
        </div>
        </div>
    </div>

    
   
<script>
    $("#country").select2({
          placeholder: "Select Country",
          allowClear: true
      });
    
    $('#billing_state').select2({
        placeholder:"Select State",
        allowClear: true
    })

</script>
</body>
</html>