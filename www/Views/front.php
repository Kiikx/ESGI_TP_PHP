<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? "Titre de ma page"; ?></title>
    <meta name="description" content="<?php echo $description ?? "Ceci est la description de la page"; ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Template du front</h1>
    <?php include $this->view; ?>
</body>

</html>