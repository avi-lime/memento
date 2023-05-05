<?php include("components/header.php"); ?>

<!-- Map Begin -->
<div class="map">
    <iframe height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"
        src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=DRB commerce college&amp;t=&amp;z=18&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>You can visit us at the following address or send us a message.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Surat</h4>
                            <p>New City Light Rd. Bharthana (Vesu) <br />PH: 2262951</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea id="message" name="message" placeholder="Message"></textarea>
                                <button type="submit" id="send_mail" name="send_mail" class="site-btn">Send
                                    Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto">Memento</strong>
                        <small>Just now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {

        $("#send_mail").click(function (e) {
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let message = $('#message').val();
            let subject = "User Here";
            let altbody = "User request";

            console.log([name, email, message, subject, altbody])

            $("#send_mail").attr("disabled", true)
            setTimeout(() => {
                $("#send_mail").attr("disabled", false)
            }, 20000);
            $.ajax({
                url: "mail/index.php",
                data: {
                    email: email,
                    subject: "Thanks for reaching out!",
                    body: "We've received your message and we'll respond to you shortly!",
                    altbody: altbody,
                    fromMail: "jigyasusharma2803@gmail.com",
                    fromName: "MEMENTO",
                    contact: true
                },
                success: function (data) {
                    console.log(data);
                    $(".toast-body").text("E-Mail Sent, We'll respond to you shortly.")
                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()

                    $('#name').val("");
                    $('#email').val("");
                    $('#message').val("");

                    $.ajax({
                        url: "api/message.php",
                        data: {
                            message: message,
                            email: email,
                            name: name
                        },
                        success: function (data) {

                        }
                    })
                }
            })
        })
    })
</script>
<!-- Contact Section End -->
<?php include("components/footer.php"); ?>