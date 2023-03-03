</div>
</div>
</div>
<div class="back-to-top">
    <a class="btn btn-light btn-circle rounded-circle" style="width: 38px" role="button" href="#"><i
            class="fa-solid fa-caret-up"></i></a>
</div>
<?php
function redirect($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
        exit;
    }
}
?>
<!-- bootstrap js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="../js/jquery.nice-select.min.js"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    // toggle sidebar on windows resize
    $(window).resize(function () {
        if ($(window).width() < 850) {
            $(".sidebar").removeClass("active");
            $(".main,.header").addClass("open");
            $(".main,.header").removeClass("blur");
        } else {
            $(".sidebar").addClass("active");
            $(".main,.header").removeClass("open");
            // $(".main,.header").addClass("blur");
        }
    })

    var elements = $(".sidebar.active .link_names,.sidebar.active .brand-link").each(function (index, element) {
        element.addEventListener('touchstart', function (e) {
            e.preventDefault();
        })
    })


    if ($(document).scrollTop() < 600) {
        $(".back-to-top").hide();
    }

    $(document).ready(function () {

        // set active link
        const currentLocation = location.href;
        $("a").each(function (index, element) {
            const linkRegEx = new RegExp(`^${currentLocation}`)
            if (linkRegEx.test(element.href)) {
                $(element).parent('li').addClass("active");
            }
        });

        // set sidebar toggle state based on device/window width
        if ($(window).width() < 850) {
            $(".sidebar").removeClass("active");
            $(".main,.header").addClass("open");
        } else {
            $(".main,.header").removeClass("open");
            $(".main,.header").removeClass("blur");
            $(".sidebar").addClass("active");
        }

        $(".sidebar-toggler").click(function () {
            $(".main,.header").toggleClass("open");
            $(".sidebar").toggleClass("active");
            if ($(window).width() < 850) {
                $(".header,.main").toggleClass("blur")
            }
        })

        // close sidebar when tapped outside
        $(".main").click(function (e) {
            if ($(window).width() < 850) {
                if ($('.sidebar').hasClass("active")) {
                    $(".sidebar").removeClass("active")
                    $(".header,.main").removeClass("blur")
                }
            }
        })

        $(".sort select").niceSelect();

    })

    $(document).scroll(function () {
        let y = $(this).scrollTop();
        if (y > 600) {
            $(".back-to-top").fadeIn();
        } else {
            $(".back-to-top").fadeOut();
        }
    })

</script>
</body>

</html>