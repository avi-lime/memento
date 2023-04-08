<?php
include("template/header.php");
include("../global/api/conn.php");

if (!isset($_SESSION["super"]) || $_SESSION["super"] != 1) {
    $super = false;
} else {
    $super = true;
}

?>
<div class="card">
    <h1>Messages</h1>
    <hr>
    <div class="actions">
        <?php if ($super) { ?>
            <button type="button" class="my-btn" data-bs-toggle="modal" data-bs-target="#modal" id="btnAdd">
                Send E-Mail
            </button>
        <?php } ?>
        <div class="sort">
            <select class="nice-select" name="sort" id="sort">
                <option value="ORDER BY id">ID, 1-9</option>
                <option value="ORDER BY id DESC">ID, 9-1</option>
                <option value="ORDER BY name">Name, A-Z</option>
                <option value="ORDER BY name DESC">Name, Z-A</option>
                <option value="ORDER BY sent_time">Time Sent</option>
                <option value="ORDER BY sent_time DESC" selected>Time Desc</option>
            </select>
        </div>
        <input type="text" class="search-bar" name="search" id="search" data-table="category" placeholder="Search...">
    </div>

    <!-- Send an Email -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="mdlLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="mdlLabel">
                        Send E-Mail
                    </h5>
                    <button type="button" class="btn-close-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="modal-body">
                    <form id="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Subject: *</label>
                            <input required id="subject" name="subject" type="text" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Reciever's Email: *</label>
                            <input required id="email" name="email" type="email" class="form-control mb-3">
                        </div>
                        <div class="form-group">
                            <label>Message: *</label>
                            <textarea required id="message" name="message" rows="3"
                                class="form-control mb-3"> </textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" form="form" type="reset" data-bs-dismiss="modal">Cancel</button>
                    <button name="btnSubmit" form="form" type="submit" class="btn" id="btnSubmit">Send</button>
                </div>

            </div>
        </div>
    </div>

    <!-- list of items -->
    <div class="list row" id="list">
    </div>

</div>
<script>
    // fetch before load
    fetch_filter_sort();

    $(document).ready(function () {

        $('#list').on("click", "a.btn-reply", function () {
            var id = $(this).attr("id").split("-")[1];
            $.ajax({
                url: 'api/fetch.php',
                method: 'POST',
                data: {
                    query: "SELECT * FROM messages WHERE id=" + id
                },
                dataType: "json",
                success: function (data) {
                    let parsedData = $.parseJSON(data[0]);
                    $("#id").val(parsedData.id);
                    $("#subject").val(`Reply to ${parsedData.name}`);
                    $("#email").val(`${parsedData.email}`);
                    $("#mdlLabel").text("Send a Reply");
                    $("#btnSubmit").text("Send");
                    $("#modal").modal('show');
                }
            })
        })



        // sort
        $("#sort").change(function () {
            fetch_filter_sort();
        });

        // search
        $("#search").keyup(function () {
            fetch_filter_sort();
        })

        // reset form on add        
        $('#btnAdd').click(function () {
            $("#id").val("");
            $("#subject").val("");
            $("#email").val("");
            $("#mdlLabel").text("Send E-Mail");
            $("#btnSubmit").text("Send");
        })

        $("#btnSubmit").click(function (e) {
            e.preventDefault();
            let id = $("#id").val();
            let email = $("#email").val();
            let subject = $("#subject").val();
            let message = $("#message").val();
            let admin = "<?= $_SESSION["admin"] ?>";
            $.ajax({
                url: "../mail/index.php",
                data: {
                    email: email,
                    subject: subject,
                    body: message,
                    altbody: "Support Response",
                    fromMail: "jigyasusharma2803@gmail.com",
                    fromName: "MEMENTO",
                    contact: true
                },
                success: function (data) {
                    console.log(data);
                    $(".toast-body").text("E-Mail Sent.")
                    const toast = new bootstrap.Toast($("#liveToast"))
                    toast.show()

                }
            })

            $.ajax({
                url: "../api/message.php",
                data: {
                    message: message,
                    email: email,
                    name: name,
                    replied_to: id,
                    replied_by: admin
                },
                success: function (data) {
                    $("#modal").modal('toggle');

                }
            })

            fetch_filter_sort();
        })
    })

    function fetch_filter_sort() {
        let params = "";
        let search = $("#search").val();
        let sort_by = $("#sort").val();
        if (search != "") params += ` AND name LIKE '%${search}%' OR id LIKE '${search}%' OR email LIKE '%${search}%' OR message LIKE '%${search}%'`;
        params += ` ${sort_by}`
        $.ajax({
            url: 'api/fetch.php',
            method: 'POST',
            data: {
                query: `SELECT * FROM messages WHERE replied_to IS NULL` + params
            },
            dataType: "json",
            success: function (data) {
                let content = ""
                data.forEach(item => {
                    let parsedItem = $.parseJSON(item);
                    let sent_date = new Date(parsedItem.sent_time);
                    content += `
                         <div class="p-1 col-12 mb-1">
                            <div class="card bg-black text-white h-100" id="${parsedItem.id}" style="scroll-margin-top: 100px;">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        ${parsedItem.id}. ${parsedItem.name}
                                    </h5>
                                    <p class="card-text">
                                        ${parsedItem.email.replace(/\n/g, "<br>")}
                                    </p>
                                    <p class="card-text">
                                        ${parsedItem.message.replace(/\n/g, "<br>")}
                                    </p>
                                </div>
                            <ul id="replies-${parsedItem.id}" class="replies list-group list-group-flush">
                            </ul>    
                            <div class="card-body pb-0">
                                    <?php if ($super) { ?>
                                                                                                                                                                                                            <a role="button" id="reply-${parsedItem.id}" class="btn my-btn btn-reply">Reply</a>
                                    <?php } ?>
                                </div>
                                <div class="card-footer">
                                    ${sent_date.toLocaleString()}
                                </div>
                            </div>
                        </div>
                        `;
                })
                $("#list").html(content)
                $(".replies").each(function () {
                    let id = $(this).attr("id").split("-")[1];
                    $.ajax({
                        url: 'api/fetch.php',
                        data: {
                            query: "SELECT m.id, m.message, a.username FROM messages m LEFT JOIN admin a ON m.replied_by=a.id WHERE m.replied_to=" + id
                        },
                        dataType: "json",
                        success: function (data) {
                            let content = ""
                            if (data.length > 0) {
                                data.forEach(reply => {
                                    let r = $.parseJSON(reply)
                                    content += `
                                        <li class="list-group-item bg-black text-white border-white">
                                        <b>Reply By:</b> ${r.username}<br>
                                        ${r.message}
                                        </li>
                                        `
                                })
                                $(`#replies-${id}`).html(content)
                            }
                        }
                    })
                })
            }
        })
    }


</script>
<?php include("template/footer.html") ?>