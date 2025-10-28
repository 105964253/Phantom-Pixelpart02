<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Recruiting Tech employees for a game development studio">
  <meta name="keywords" content="Tech, Game Development, Careers">
  <meta name="author" content="Phantom Pixel">
  <title>Phantom Pixel</title>

  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" href="styles/fonts.css">

  <style>
        #summary { /* embedded css example - all of which relates to the summary */
            background-color: #0a121c;
            border-radius: 16px;
            display: flex;
            align-items: center;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
        }

        .sumtext{
            color: #f3f3f1;
            padding: 20px 40px 20px 40px;
            flex: 1; /*  text fills remaining space in container */
        }

        .sumtext strong {
            color: #f3f3f1;
        }

        #phantompixeloffice {
            border-radius: 16px;
            height: auto;
            max-width: 350px;
            padding: 9px;
        }
  </style>

</head>

<body id="applybody">
    <section id="pageheader">
        <?php include 'header.inc'; ?>
        <?php include 'nav.inc'; ?>
        </header>
    </section>

    <main id="applymain">
        <br>
        <section id="summary"> <!-- short summary above the application form -->
            <div class="sumtext">
                <h2 style="color: #ff3a95;">Thank you for your interest</h2> <!-- inline css examples -->
                <hr style="color: #ff3a95;">
                <p style="color: #f3f3f1;">We greatly appreciate your interest in joining us at <span style="color: #ff3a95;">Phantom Pixel</span>. By applying, you are taking the first step toward becoming part of a team that values <strong>innovation</strong>, <strong>collaboration</strong>, <strong>creativity</strong> &amp; <strong>growth</strong>. To apply, please complete the form below.</p>
            </div>

            <img src = "styles/images/phantompixeloffice.png" id = "phantompixeloffice" alt = "Phantom Pixel Office" width="350"> <!-- image generated with ChatGPT -->

        </section>

        <br> 

        <section id="jobform"> <!-- form start -->
            <h2>APPLICATION FORM</h2>
            <form action="process_eoi.php" method="post" novalidate>

                <div id="jobreference">
                    <label for="jobref"><strong>Job Reference Number:  </strong></label>
                    <input type="text" id="jobref" name="jobref" placeholder="Enter reference number" maxlength="5" pattern="^[A-Za-z0-9]{5}$" required>
                </div>

                <br>

                <div id="personal">

                    <div id="firstname">
                        <label for="firstN">First Name:  </label> <!-- firstN used as id to style the input field seperately to the div --> 
                        <input type="text" id="firstN" name="firstname" placeholder="Enter your given name" maxlength="20" pattern="^[A-Za-z]+(?:[ '\-][A-Za-z]+)*$" required>
                    </div>

                    <br>
                    
                    <div id="lastname">
                        <label for="lastN">Last Name:  </label> <!-- lastN used as id to style the input field seperately to the div -->
                        <input type="text" id="lastN" name="lastname" placeholder="Enter your family name" maxlength="20" pattern="^[A-Za-z]+(?:[ '\-][A-Za-z]+)*$" required>
                    </div>

                    <br>

                    <div id="dateofbirth">
                        <label for="dob">Date of Birth:  </label>
                        <input type="date" id="dob" name="dob" required>
                    </div>

                    <fieldset id="gender">
                        <legend>Gender</legend>

                        <input type="radio" id="gmale" name="gender" value="Male" required>
                        <label for="gmale">Male</label> <!-- id field include 'g' prefix for each option -->

                        <input type="radio" id="gfemale" name="gender" value="Female">
                        <label for="gfemale">Female</label>

                        <input type="radio" id="gnonbinary" name="gender" value="Non-Binary">
                        <label for="gnonbinary">Non-binary</label>

                        <input type="radio" id="gother" name="gender" value="Other">
                        <label for="gother">Prefer not to say</label>

                        <br>
                    </fieldset>
                </div>

                <br>

                <div id="address">
                    <label class="formtitles">address</label> <!-- formtitles class used for styling each title of each section -->

                    <div id="street">  
                        <label for="staddress"></label>
                        <input type="text" id="staddress" name="address[]" placeholder="Enter your street address" maxlength="40" pattern="[0-9A-Za-z\s.,/-]+" required>
                    </div>

                    <div id="addressdetail"> 
                        <input type="text" id="subtown" name="address[]" placeholder="Enter your suburb/town" maxlength="40" pattern="[0-9A-Za-z\s.,/-]+" required>
                        <input type="text" id="postcode" name="address[]" placeholder="Enter postcode" pattern="[0-9]{4}$" required>
                            <select id="state" name="address[]" required>
                                <option value="" disabled>Please pick one</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="NT">NT</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                    </div>
                </div>

                <br>

                <div id="contacts">
                    <label class="formtitles">contact details</label>

                    <div id="contactlabel"> <!-- top flexbox row div for contact -->
                        <label for="email">Email address*</label>
                        <label for="hnum">Home phone</label>
                        <label for="pnum">Mobile phone*</label>
                    </div>

                    <div id="contactinput"> <!-- bottom flexbox row div for contacts-->
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                        <input type="text" id="hnum" name="hnum" placeholder="Enter your home number" pattern="^\+?\d{8,12}$"> <!-- optional home phone -->
                        <input type="text" id="pnum" name="pnum" placeholder="Enter your mobile number" pattern="^\+?\d{8,12}$" required>
                    </div>
                </div>

                <br>

                <fieldset id="SkillList">
                    <label class="formtitles">relevant skills*</label>

                    <div class="skills">
                        <input type="checkbox" id="skill1" name="skills[]" value="Skill 1" required>
                        <label for="skill1"> C++ / C# proficiency (Unity or Unreal)</label>
                    </div>

                    <div class="skills">
                        <input type="checkbox" id="skill2" name="skills[]" value="skill 2">
                        <label for="skill2"> Git version control</label>
                    </div> 

                    <div class="skills">
                        <input type="checkbox" id="skill3" name="skills[]" value="skill 3">
                        <label for="skill3"> Debugging and performance profiling</label>
                    </div> 

                    <div class="skills">
                        <input type="checkbox" id="skill4" name="skills[]" value="skill 4">
                        <label for="skill4"> Agile/Scrum development workflow</label>
                    </div> 

                    <div class="skills">
                        <input type="checkbox" id="skillOther" name="skills[]" value="skill other">
                        <label for="skillOther"> Other skills (please enter below)...</label> 
                    </div>

                    <div class="skills">
                        <textarea name="skillcomment" id="skillcomment" rows="4" cols="50">Other skills...</textarea>
                    </div>
                </fieldset>

                <br><br>

                <div id="formbuttons">
                    <input type="submit" value="submit">
                    <input type="reset" value="clear">
                </div>
            </form>
        </section>
    </main>

    <?php include 'footer.inc'; ?>
</body>