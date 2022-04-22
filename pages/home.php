<?php
include "../utils.php";
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<?php
    include "navbar.php";
?>

<?php
    if (!is_user_logged_in()) {
        redirect_to_login_page();
    }
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-dark" id="catalog_msg">
                My Catalog
            </div>
        </div>
    </div>
    <div class="mb-3" id="bought_container">

    </div>
    <div class="row">
        <div class="col">
            <div class="alert alert-info" id="buy_msg">
                Available books
            </div>
        </div>
    </div>
    <div class="mb-3" id="buy_container">

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="requests.js"></script>
<script>

    function get_bought_books() {
        update_catalog_msg(true);
        get_request(
            "../forms/bought_books.php?fetch=true",
            null,
            (resp) => {
                display_bought_books(resp['books']);
                update_catalog_msg(false);
            },
            (resp) => {
                console.log(resp);
                update_catalog_msg(false);
            }
        )
    }

    function update_catalog_msg(loading) {
        let catalog_msg_div = document.getElementById("catalog_msg");
        if (!loading) {
            catalog_msg_div.innerHTML = "<span class='fa fa-book'></span> My Catalog";
            return;
        }

        catalog_msg_div.innerHTML = `<span class="fa fa-spinner fa-spin"></span> Updating your catalog`;
    }

    function get_can_buy_books() {
        update_buy_msg(true);
        get_request(
            "../forms/books_to_buy.php?fetch=true",
            null,
            (resp) => {
                display_buy_books(resp['books']);
                update_buy_msg(false);
            },
            (resp) => {
                console.log(resp);
                update_buy_msg(false);
            }
        )
    }

    function update_buy_msg(loading) {
        let buy_msg_div = document.getElementById("buy_msg");
        if (!loading) {
            buy_msg_div.innerHTML = "<span class='fa fa-cart-arrow-down'></span> Available books";
            return;
        }

        buy_msg_div.innerHTML = `<span class="fa fa-spinner fa-spin"></span> Updating books`;
    }

    function display_bought_books(books) {
        let bought_div = "";
        books.forEach((elem, i) => {
            if (i % 2 === 0) {
                bought_div += `<div class="row mb-2">`;
            }

            bought_div += `<div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">${elem.name}</h5>
                                        <p class="card-text">${elem.description}</p>
                                    </div>
                                </div>
                            </div>`

            if (i % 2 !== 0)
                bought_div += `</div>`;

        });

        document.getElementById("bought_container").innerHTML = bought_div;
    }

    function display_buy_books(books) {
        let buy_div = "";
        books.forEach((elem, i) => {
            if (i % 2 === 0)
                buy_div += `<div class="row mb-2">`;

            buy_div += `<div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${elem.name}</h5>
                                    <p class="card-text">${elem.description}</p>
                                    <button type="button" onclick="buy_book(${elem.id}, this)" class="btn btn-primary">Buy Book</button>
                                </div>
                            </div>
                        </div>`

            if (i % 2 !== 0)
                buy_div += `</div>`;
        });

        document.getElementById("buy_container").innerHTML = buy_div;
    }

    function buy_book(book_id, elementRef) {
        elementRef.innerHTML = `<span class="fa fa-spinner fa-spin"></span>Buying`;

        let formData = new FormData();
        formData.append("book_id", book_id);

        post_request(
            "../forms/buy_book.php",
            formData,
            (resp) => {
                get_can_buy_books();
                get_bought_books();
            },
            (resp) => {
                console.log(resp);
            },
        )
    }

    get_bought_books();
    get_can_buy_books();
</script>
</body>
</html>