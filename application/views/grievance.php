<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <?php include 'include/headerlink.php' ?>
</head>

<body>

  <?php include 'include/header.php' ?>

  <section class="inner_banner grievance">
			<div class="container">
				<h1>Grievance <span></span></h1>
				<ul class="breadcrum">
					<li><a href="<?= base_url() ?>">Home</a></li>
					<li>Grievance</li>
				</ul>
			</div>
		</section>

  <section class="form_info">
    <div class="container">
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <h5 class="color_white form_head">Grievance Redressal</h5>
          <div class="content_box">

            <p class="color_white">Aadarsh Technosoft Pvt Ltd is a founding member of the IEC, which is a self-regulatory body.
              </p>
              <p  class="color_white">As a member of IEC, Aadarsh Technosoft Pvt Ltd is committed to resolving grievances within 30 days.</p>
              <p  class="color_white">As a member of IEC, Aadarsh Technosoft Pvt Ltd is committed to resolving grievances within 30 days.</p>
              <p  class="color_white">This is the official page and you can share your queries, feedback, or any concerns you may have about Aadarsh Technosoft Pvt Ltd or our programs.</p>
              
              <p class="color_white">Our dedicated team will respond to you within 2 business days.</p>
            </div>
            </div>
            
            <div class="col-md-6 col-sm-12">
              <h5 class="color_white form_head">Fill the form</h5>
              <form action="">
            <input type="text" class="form-control" placeholder="Learner Name">
            <input type="text" class="form-control" placeholder="Parent Name">
            <input type="tel" class="form-control" placeholder="Register Mobile Number">
            <input type="tel" class="form-control" placeholder="Alternate Mobile Number">
            <select name="concern" id="" class="form-control">
              <option value="" selected>Select Concern Type</option>
              <option value="Refund Related">Refund Related</option>
              <option value="Deferred Related">Deferred Related</option>
              <option value="Acadimic Doubts">Acadimic Doubts</option>
              <option value="Extension Related">Extension Related</option>
              <option value="Grading Related">Grading Related</option>
              <option value="Certification Related">Certification Related</option>
              <option value="Academic Counsellor">Academic Counsellor</option>
              <option value="Student Mentor">Student Mentor</option>
              <option value="Technical Issue">Technical Issue</option>
              <option value="Other">Other</option>
            </select>
            <textarea name="message" id="" cols="10" class="form-control textarea" placeholder="Your Message"></textarea>
            <div class="btn-block text-center sub_btn">
              <button class="buy_btn radial-out">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>







  <?php include 'include/footer.php' ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <?php include 'include/footerlink.php' ?>
  <script>
    $(document).on('change', '#state', function() {

      var state = $(this).val();

      $.ajax({
        method: "POST",
        url: "<?= base_url('home/getcity') ?>",
        data: {
          state: state
        },
        success: function(response) {
          // console.log(response);
          $('#city').html(response);
        }
      });
    });
    document.getElementById('video-player').controls = false;
  </script>

  <script>
    $(document).ready(function() {
      // Configure/customize these variables.
      var showChar = 200; // How many characters are shown by default
      var ellipsestext = "...";
      var moretext = "Show more >";
      var lesstext = "Show less";


      $('.more').each(function() {
        var content = $(this).html();

        if (content.length > showChar) {

          var c = content.substr(0, showChar);
          var h = content.substr(showChar, content.length - showChar);

          var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

          $(this).html(html);
        }

      });

      $(".morelink").click(function() {
        if ($(this).hasClass("less")) {
          $(this).removeClass("less");
          $(this).html(moretext);
        } else {
          $(this).addClass("less");
          $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
      });
    });
  </script>
</body>

</html>