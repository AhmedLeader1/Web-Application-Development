<!--============================================INDEX(MAIN) PAGE=================================================-->
<!--
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the MAIN page. It contains:
                1- A HTML that displays some welcoming message for the user
                II- A Header that contains Registration link, a sign in link
                II- other useful information for the user.

-->
<!DOCTYPE html>
<html lang="en">
    <!--meta data-->
    <head>
      <?php
      $PAGE_TITLE = "Home page|welcome";
      include "includes/metadata.php";
      ?>
    </head>
    <!--content-->
    <body>
        <!-- header -->
        <div id="header">
        <?php include "includes/header.php"; ?>
          </div>
        <!-- Main Content -->
        <main>

          <!-- this section will contain a background photo and one or two statements -->
          <section id="showarea">

              <h2>Welcome to the BucketList application</h2>
            <figure>
              <img src="img/image3.jpg" alt="">
              <img src="img/Optimized-image4.jpg" alt="">
            </figure>
            <div class="caption1">Start listing you own goals &amp; the adventures you want to fulfill in the near future</div>
            <div class="caption2">Together we can fulfill each other's dreams!</div>
            <button class="indexButton1" type="button"  name="SignUp"><a href="https://bestow.com/blog/bucket-list-ideas/">View some Bucketlist Ideas</a></button>
            </section>
          <!-- a nother section -->
          <section class="functionality">
            <h2>Live your life to the fulliest</h2>
            <!-- Icons -->
            <div class="Icons">
              <div class="row">
                <table>
                  <tr>
                    <td><img src="https://img.icons8.com/cute-clipart/64/000000/goal.png" alt=""></td>
                    <td><div class="iconHeader">Set Your Goal</div> </td>
                  </tr>
                  <tr>
                    <td><img src="https://img.icons8.com/android/48/000000/handshake.png" alt=""></td>
                    <td> <div class="iconHeader">The Power Of Two</div> </td>
                  </tr>
                </table>
              </div>
              <div class="row">
                <table>
                  <tr>
                    <td> <img src="img/superhero.png" alt=""> </td>
                    <td><div class="iconHeader">Be Your Hero</div></td>
                  </tr>
                  <tr>
                    <td><img src="https://img.icons8.com/color/48/000000/numbered-list.png" alt=""></td>
                    <td><div class="iconHeader">Make A Bucket List</div></td>
                  </tr>
                </table>
              </div>
              <div class="row">
                <table>
                  <tr>
                    <td>
                      <div class="share">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane" class="svg-inline--fa fa-paper-plane fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="gray" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"></path></svg>
                      </div>
                    </td>
                    <td><div class="iconHeader">Share With Friends</div></td>
                  </tr>
                  <tr>
                    <td><img src="https://img.icons8.com/ios-filled/50/000000/heart-with-pulse.png" alt=""></td>
                    <td> <div class="iconHeader">Live It Up!</div> </td>
                  </tr>
                </table>
              </div>
            </div>
          </section>
        </main>
        <!--footer-->
        <?php include "includes/footer.php"; ?>
    </body>
</html>
