<?php
require "app/autoload.php";

use App\Controller\HomeController;
use App\Request\Request;

$request = new Request();
$repositories = (new HomeController())->index($request);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corexc</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <section id="search">
        <form action="index.php" method="post" class="form" autocomplete="off">
            <div class="row">
                <input type="text" placeholder="keyword" name="keyword" value="<?= $request->keyword ?>" />
                <input type="number" min="1" max="255" placeholder="page" name="page" value="<?= $request->page ?>" />
                <input type="number" min="1" max="100" placeholder="per page" name="per_page" value="<?= $request->per_page ?>" />
                <input type="text" placeholder="language" name="language" list="language-list" id="language" value="<?= $request->language ?>" />
                <datalist id="language-list">
                    <option value="PHP">
                    <option value="JavaScript">
                    <option value="HTML">
                    <option value="CSS">
                    <option value="Hack">
                    <option value="TSQL">
                    <option value="SCSS">
                    <option value="C#">
                    <option value="Blade">
                    <option value="Java">
                </datalist>
            </div>
            <div class="row">
                <input type="date" placeholder="created" name="created" value="<?= $request->created ?? '2019-01-10' ?>" />
                <select name="order">
                    <option value="desc" <?= ($request->order == 'desc') ? 'selected' : null ?>>Desc</option>
                    <option value="asc" <?= ($request->order == 'asc') ? 'selected' : null ?>>Asc</option>
                </select>
                <button>Search</button>
            </div>
        </form>
    </section>
    <section id="query">
        <div class="row">
            <h3>Total Count: <?= $repositories->total_count ?></h3>
            <h3>Current Page:<?= $request->page ?? 1 ?></h3>
            <h3>Per Page: <?= $request->per_page ?? 20 ?></h3>
        </div>
    </section>
    <section>
        <div class="row">
            <?php foreach ($repositories->items as $index => $item) { ?>
                <div class="blog-box card">
                    <div class="wrapper" style="background-image: url('<?= $item->owner->avatar_url ?>');">
                        <div class="date">
                            <span class="day"><?= $item->language ?></span>
                            <span class="month"><?= $item->watchers ?></span>
                            <span class="year"><?= date('d M, Y', strtotime($item->created_at)) ?></span>
                        </div>
                        <div class="data">
                            <div class="content">
                                <a href="<?= $item->owner->html_url ?>"><span class="author"><?= $item->owner->login ?></span></a>
                                <h4 class="title"><a href="<?= $item->html_url ?>"><?= $item->full_name ?></a></h4>
                                <h6 class="text"><?= $item->description ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>