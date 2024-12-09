<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Titre de ma page</title>
        <meta name="description" content="Ceci est la description de la page">
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
        <h1>Template du back</h1>
        <?php include $this->view;?>

    </body>
</html>

